<?php

namespace App\Http\Controllers\Agents;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Services\ExpoNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class N8nController extends Controller
{
    /** Number of articles per page for agent API. */
    private const PER_PAGE = 50;

    public function __construct(
        private ExpoNotificationService $expoNotificationService
    ) {}

    // ---------- Articles ----------

    /**
     * List all articles (any status) for agent/n8n. Paginated. Use ?status=published to filter.
     *
     * @queryParam page integer Page number. Example: 1
     * @queryParam status string optional Filter by status: draft, published, archived. Example: published
     */
    public function index(Request $request)
    {
        $query = Article::query()->orderByDesc('updated_at');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $articles = $query->paginate(self::PER_PAGE);
        $items = collect($articles->items())->map(fn (Article $a) => $a->toArray())->all();

        return HttpStatusCode::OK->toResponse([
            'data' => $items,
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
        ]);
    }

    /**
     * List published articles only (full body). Kept for backward compatibility.
     *
     * @queryParam page integer Page number. Example: 1
     */
    public function getAllArticles(Request $request)
    {
        $articles = Article::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate(self::PER_PAGE);

        $items = collect($articles->items())->map(fn (Article $article) => $article->toArray())->all();

        return HttpStatusCode::OK->toResponse([
            'data' => $items,
            'meta' => [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ],
        ]);
    }

    /**
     * Get a single article by id or slug.
     */
    public function show(Article $article)
    {
        return HttpStatusCode::OK->toResponse([
            'data' => $article->toArray(),
        ]);
    }

    /**
     * Create an article. Slug is auto-generated from title if not provided.
     *
     * @bodyParam title string required Example: My new post
     * @bodyParam slug string optional Unique URL slug. Auto-generated from title if omitted.
     * @bodyParam excerpt string optional Short summary.
     * @bodyParam body string required HTML or plain content.
     * @bodyParam image string optional Cover image URL or path.
     * @bodyParam status string optional draft|published|archived. Default: draft
     * @bodyParam published_at string optional ISO datetime. Required when status=published.
     * @bodyParam topics array optional Topic IDs or labels.
     * @bodyParam meta object optional Extra metadata.
     * @bodyParam is_featured boolean optional Default: false
     * @bodyParam sort_order integer optional Default: 0
     * @bodyParam user_id string optional Author user UUID. Null for system.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['sometimes', 'nullable', 'string', 'max:255', 'unique:articles,slug'],
            'excerpt' => ['sometimes', 'nullable', 'string'],
            'body' => ['required', 'string'],
            'image' => ['sometimes', 'nullable', 'string', 'max:500'],
            'status' => ['sometimes', 'string', 'in:draft,published,archived'],
            'published_at' => ['sometimes', 'nullable', 'date'],
            'topics' => ['sometimes', 'nullable', 'array'],
            'meta' => ['sometimes', 'nullable', 'array'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'user_id' => ['sometimes', 'nullable', 'uuid', 'exists:users,id'],
        ], [
            'slug.unique' => 'The slug is already in use.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $slug = $request->input('slug') ?: $this->uniqueSlugFromTitle($request->input('title'));
        $status = $request->input('status', 'draft');
        $publishedAt = $request->input('published_at');
        if ($status === 'published' && $publishedAt === null) {
            $publishedAt = now()->toIso8601String();
        }

        $article = Article::create([
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'slug' => $slug,
            'excerpt' => $request->input('excerpt'),
            'body' => $request->input('body'),
            'image' => $request->input('image'),
            'status' => $status,
            'published_at' => $publishedAt ? \Carbon\Carbon::parse($publishedAt) : null,
            'topics' => $request->input('topics'),
            'meta' => $request->input('meta'),
            'is_featured' => (bool) $request->input('is_featured', false),
            'sort_order' => (int) $request->input('sort_order', 0),
        ]);

        return HttpStatusCode::Created->toResponse([
            'message' => 'Article created.',
            'data' => $article->toArray(),
        ]);
    }

    /**
     * Update an article. Only provided fields are updated.
     */
    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['sometimes', 'string', 'max:255'],
            'slug' => ['sometimes', 'string', 'max:255', 'unique:articles,slug,' . $article->id],
            'excerpt' => ['sometimes', 'nullable', 'string'],
            'body' => ['sometimes', 'string'],
            'image' => ['sometimes', 'nullable', 'string', 'max:500'],
            'status' => ['sometimes', 'string', 'in:draft,published,archived'],
            'published_at' => ['sometimes', 'nullable', 'date'],
            'topics' => ['sometimes', 'nullable', 'array'],
            'meta' => ['sometimes', 'nullable', 'array'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0'],
            'user_id' => ['sometimes', 'nullable', 'uuid', 'exists:users,id'],
        ], [
            'slug.unique' => 'The slug is already in use.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $data = $request->only([
            'title', 'slug', 'excerpt', 'body', 'image', 'status', 'topics', 'meta', 'user_id',
        ]);
        if ($request->has('is_featured')) {
            $data['is_featured'] = (bool) $request->input('is_featured');
        }
        if ($request->has('sort_order')) {
            $data['sort_order'] = (int) $request->input('sort_order');
        }
        if ($request->has('published_at')) {
            $data['published_at'] = $request->input('published_at')
                ? \Carbon\Carbon::parse($request->input('published_at'))
                : null;
        }

        $article->update($data);

        return HttpStatusCode::OK->toResponse([
            'message' => 'Article updated.',
            'data' => $article->fresh()->toArray(),
        ]);
    }

    /**
     * Soft-delete an article.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }

    // ---------- Notifications ----------

    /**
     * Send Expo push notification to users. Omit user_ids to broadcast to all users with registered tokens.
     *
     * @bodyParam title string required Notification title.
     * @bodyParam body string optional Notification body.
     * @bodyParam data object optional Payload for the app (e.g. {"article_id": "...", "screen": "Article"}).
     * @bodyParam type string optional Notification type/category.
     * @bodyParam user_ids array optional List of user UUIDs. If empty, send to all users with Expo tokens.
     */
    public function sendNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'data' => ['sometimes', 'nullable', 'array'],
            'type' => ['sometimes', 'nullable', 'string', 'max:100'],
            'user_ids' => ['sometimes', 'nullable', 'array'],
            'user_ids.*' => ['uuid', 'exists:users,id'],
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $title = $request->input('title');
        $body = $request->input('body', '');
        $data = $request->input('data', []);
        $type = $request->input('type');

        $userIds = $request->input('user_ids', []);
        if (! empty($userIds)) {
            $users = User::whereIn('id', $userIds)->get();
        } else {
            $users = User::whereHas('expoPushTokens')->get();
        }

        $results = [];
        $sentCount = 0;
        foreach ($users as $user) {
            $result = $this->expoNotificationService->sendToUser($user, $title, $body, $data, $type);
            $results[] = [
                'user_id' => $user->id,
                'notification_id' => $result['notification']->id,
                'tickets_count' => count($result['tickets']),
            ];
            if (count($result['tickets']) > 0) {
                $sentCount++;
            }
        }

        return HttpStatusCode::OK->toResponse([
            'message' => 'Notifications sent.',
            'data' => [
                'target_users' => $users->count(),
                'sent_to_devices' => $sentCount,
                'results' => $results,
            ],
        ]);
    }

    // ---------- Upload ----------

    /**
     * Upload an image. Stores on the public disk and returns the full URL.
     * Accepts: image file (multipart/form-data with key "image" or "file").
     *
     * @bodyParam image file required Image file (jpeg, png, gif, webp). Max 5MB.
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => ['required_without:file', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'], // 5MB
            'file' => ['required_without:image', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:5120'],
        ], [
            'image.required_without' => 'An image file is required (field: image or file).',
            'file.required_without' => 'An image file is required (field: image or file).',
            'image.image' => 'The file must be an image.',
            'file.image' => 'The file must be an image.',
            'image.max' => 'The image may not be greater than 5MB.',
            'file.max' => 'The image may not be greater than 5MB.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $file = $request->file('image') ?? $request->file('file');
        $extension = $file->getClientOriginalExtension() ?: $file->guessExtension();
        $filename = Str::uuid() . '.' . $extension;
        $path = 'agent/uploads/' . $filename;

        Storage::disk('public')->put($path, $file->get());

        $url = Storage::disk('public')->url($path);

        return HttpStatusCode::Created->toResponse([
            'message' => 'Image uploaded.',
            'data' => [
                'url' => $url,
                'path' => $path,
            ],
        ]);
    }

    private function uniqueSlugFromTitle(string $title): string
    {
        $base = Str::slug($title);
        if ($base === '') {
            $base = 'article';
        }
        $slug = $base;
        $c = 0;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $base . '-' . (++$c);
        }

        return $slug;
    }
}
