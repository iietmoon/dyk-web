<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /** Number of articles per page (subscribed users). */
    private const PER_PAGE = 20;

    /** Number of articles shown to users without a subscription (last N). */
    private const LAST_ARTICLES_WITHOUT_SUBSCRIPTION = 10;

    /**
     * List published articles.
     * Subscribed users: paginated (20 per page).
     * Users without a subscription: only the last 10 articles (single page).
     *
     * @group Articles
     * @queryParam page integer Page number (subscribed users only). Example: 1
     */
    public function index(Request $request)
    {
        $user = $request->user()->load('subscription.plan');
        $hasSubscription = $user && $user->subscription;

        $query = Article::query()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');

        if ($hasSubscription) {
            $articles = $query->paginate(self::PER_PAGE);
            $items = collect($articles->items())->map(fn (Article $a) => $this->formatArticleForResponse($a))->all();
            $meta = [
                'current_page' => $articles->currentPage(),
                'last_page' => $articles->lastPage(),
                'per_page' => $articles->perPage(),
                'total' => $articles->total(),
                'from' => $articles->firstItem(),
                'to' => $articles->lastItem(),
            ];
        } else {
            $articles = $query->limit(self::LAST_ARTICLES_WITHOUT_SUBSCRIPTION)->get();
            $items = $articles->map(fn (Article $a) => $this->formatArticleForResponse($a))->all();
            $total = $articles->count();
            $meta = [
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $total,
                'total' => $total,
                'from' => $total > 0 ? 1 : null,
                'to' => $total > 0 ? $total : null,
            ];
        }

        return HttpStatusCode::OK->toResponse([
            'data' => $items,
            'meta' => $meta,
        ]);
    }

    /**
     * Show a single published article.
     * Subscribed users: full body. Without subscription: full body only if article is in the last 10 published; otherwise 403.
     *
     * @group Articles
     */
    public function show(Request $request, Article $article)
    {
        if ($article->status !== 'published' || ! $article->published_at || $article->published_at->isFuture()) {
            return HttpStatusCode::NotFound->toResponse();
        }

        $user = $request->user()->load('subscription.plan');
        $hasSubscription = $user && $user->subscription;

        if (! $hasSubscription) {
            $lastPublishedIds = Article::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->orderByDesc('published_at')
                ->limit(self::LAST_ARTICLES_WITHOUT_SUBSCRIPTION)
                ->pluck('id')
                ->all();

            if (! in_array($article->id, $lastPublishedIds, true)) {
                return HttpStatusCode::Forbidden->toResponse();
            }
        }

        return HttpStatusCode::OK->toResponse([
            'data' => $article->toArray(),
        ]);
    }

    /**
     * List response: short teaser for body.
     *
     * @return array<string, mixed>
     */
    private function formatArticleForResponse(Article $article): array
    {
        $arr = $article->toArray();
        $arr['body'] = Str::limit(strip_tags($article->body), 200);
        return $arr;
    }
}
