<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /** Number of articles per page. */
    private const PER_PAGE = 20;

    /** Number of free (unlocked) articles per page for users without a subscription. */
    private const FREE_UNLOCKED_COUNT = 3;

    /**
     * List published articles with pagination (20 per page).
     * Users with an active subscription get all 20 articles unlocked.
     * Users without a subscription get the first 3 unlocked and the rest locked (no body).
     * Optional: send Bearer token to apply subscription check; otherwise treated as no subscription.
     *
     * @group Articles
     * @unauthenticated
     * @queryParam page integer Page number for pagination. Example: 1
     */
    public function index(Request $request)
    {
        $articles = Article::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate(self::PER_PAGE);

        $user = $request->user()->load('subscription.plan');
        
        $hasSubscription = false;

        if($user && $user->subscription){
            $hasSubscription = true;
        }

        $items = collect($articles->items())->map(function (Article $article, int $index) use ($hasSubscription) {
            $unlocked = $hasSubscription || $index < self::FREE_UNLOCKED_COUNT;
            return $this->formatArticleForResponse($article, $unlocked);
        })->all();

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

    private function userHasActiveSubscription(Request $request): bool
    {
        $user = $request->user();
        if (! $user) {
            return false;
        }
        $user->loadMissing('subscription');
        return $user->subscription !== null;
    }

    /**
     * List response: never include full body. Unlocked = short teaser, locked = null.
     *
     * @return array<string, mixed>
     */
    private function formatArticleForResponse(Article $article, bool $unlocked): array
    {
        $arr = $article->toArray();
        $arr['unlocked'] = $unlocked;
        $arr['body'] = $unlocked
            ? Str::limit(strip_tags($article->body), 200)
            : null;
        return $arr;
    }
}
