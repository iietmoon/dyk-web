<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\ArticleBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleBookmarkController extends Controller
{
    /** Number of bookmarks per page. */
    private const PER_PAGE = 20;

    /**
     * List the current user's bookmarked articles with pagination.
     * Each item includes the bookmark (id, created_at) and the article (id, title, slug, excerpt, image, published_at).
     *
     * @group Bookmarks
     * @queryParam page integer Page number for pagination. Example: 1
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $bookmarks = ArticleBookmark::query()
            ->where('user_id', $user->id)
            ->with('article:id,title,slug,excerpt,image,published_at,status')
            ->orderByDesc('created_at')
            ->paginate(self::PER_PAGE);

        $items = $bookmarks->items();

        return HttpStatusCode::OK->toResponse([
            'data' => $items,
            'meta' => [
                'current_page' => $bookmarks->currentPage(),
                'last_page' => $bookmarks->lastPage(),
                'per_page' => $bookmarks->perPage(),
                'total' => $bookmarks->total(),
                'from' => $bookmarks->firstItem(),
                'to' => $bookmarks->lastItem(),
            ],
        ]);
    }

    /**
     * Save (add) an article to the current user's bookmarks.
     * Returns the created bookmark with a snippet of the article. Returns 409 if the article is already bookmarked.
     *
     * @group Bookmarks
     * @bodyParam article_id string required UUID of the article to bookmark. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
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

        $exists = ArticleBookmark::where('user_id', $user->id)
            ->where('article_id', $articleId)
            ->exists();

        if ($exists) {
            return HttpStatusCode::Conflict->toResponse([
                'message' => 'Article is already bookmarked.',
            ]);
        }

        $bookmark = ArticleBookmark::create([
            'user_id' => $user->id,
            'article_id' => $articleId,
        ]);

        $bookmark->load('article:id,title,slug,excerpt,image,published_at');

        return HttpStatusCode::Created->toResponse([
            'data' => $bookmark,
        ]);
    }

    /**
     * Remove one bookmark by article id.
     * Returns 204 on success. Returns 404 if the user has not bookmarked that article.
     *
     * @group Bookmarks
     * @urlParam articleId string required UUID of the article to remove from bookmarks. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
     */
    public function destroy(Request $request, string $articleId)
    {
        $user = $request->user();

        $deleted = ArticleBookmark::where('user_id', $user->id)
            ->where('article_id', $articleId)
            ->delete();

        if ($deleted === 0) {
            return HttpStatusCode::NotFound->toResponse([
                'message' => 'Bookmark not found or already removed.',
            ]);
        }

        return response()->json(null, 204);
    }

    /**
     * Remove multiple bookmarks by article ids.
     * Only the current user's bookmarks for the given articles are removed. Invalid or non-bookmarked ids are ignored (no error).
     * Response includes deleted_count.
     *
     * @group Bookmarks
     * @bodyParam article_ids array required List of article UUIDs to remove from bookmarks. Example: ["9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a", "8c3d7e1b-0a2b-3c4d-5e6f-7a8b9c0d1e2f"]
     */
    public function destroyMultiple(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'article_ids' => ['required', 'array'],
            'article_ids.*' => ['uuid'],
        ], [
            'article_ids.required' => 'article_ids array is required.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();
        $articleIds = array_values(array_unique($request->input('article_ids', [])));

        if (count($articleIds) === 0) {
            return HttpStatusCode::OK->toResponse([
                'data' => [
                    'deleted_count' => 0,
                ],
            ]);
        }

        $deletedCount = ArticleBookmark::where('user_id', $user->id)
            ->whereIn('article_id', $articleIds)
            ->delete();

        return HttpStatusCode::OK->toResponse([
            'data' => [
                'deleted_count' => $deletedCount,
            ],
        ]);
    }
}
