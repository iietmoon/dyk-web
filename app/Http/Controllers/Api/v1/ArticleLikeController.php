<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\ArticleLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleLikeController extends Controller
{
    /**
     * Like an article. Idempotent: returns 201 on first like, 200 if already liked.
     *
     * @group Likes
     * @bodyParam article_id string required UUID of the article to like. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'article_id' => ['required', 'uuid', 'exists:articles,id'],
        ], [
            'article_id.exists' => 'The selected article does not exist.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();
        $articleId = $request->input('article_id');

        $like = ArticleLike::firstOrCreate(
            [
                'user_id' => $user->id,
                'article_id' => $articleId,
            ]
        );

        $like->load('article:id,title,slug,image,published_at');

        $status = $like->wasRecentlyCreated ? HttpStatusCode::Created : HttpStatusCode::OK;

        return $status->toResponse([
            'message' => $like->wasRecentlyCreated ? 'Article liked.' : 'Article already liked.',
            'data' => $like,
        ]);
    }

    /**
     * Remove (unlike) an article. Returns 204 on success, 404 if the user had not liked that article.
     *
     * @group Likes
     * @urlParam articleId string required UUID of the article to unlike. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
     */
    public function destroy(Request $request, string $articleId)
    {
        $user = $request->user();

        $deleted = ArticleLike::where('user_id', $user->id)
            ->where('article_id', $articleId)
            ->delete();

        if ($deleted === 0) {
            return HttpStatusCode::NotFound->toResponse([
                'message' => 'Like not found or already removed.',
            ]);
        }

        return response()->json(null, 204);
    }

    /**
     * List the current user's liked article ids (or full likes with article snippet).
     *
     * @group Likes
     * @queryParam page integer Page number for pagination. Example: 1
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $likes = ArticleLike::query()
            ->where('user_id', $user->id)
            ->with('article:id,title,slug,excerpt,image,published_at')
            ->orderByDesc('created_at')
            ->paginate(20);

        return HttpStatusCode::OK->toResponse([
            'data' => $likes->items(),
            'meta' => [
                'current_page' => $likes->currentPage(),
                'last_page' => $likes->lastPage(),
                'per_page' => $likes->perPage(),
                'total' => $likes->total(),
                'from' => $likes->firstItem(),
                'to' => $likes->lastItem(),
            ],
        ]);
    }
}
