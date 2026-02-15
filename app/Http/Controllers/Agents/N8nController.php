<?php

namespace App\Http\Controllers\Agents;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class N8nController extends Controller
{
    /** Number of articles per page for agent API. */
    private const PER_PAGE = 50;

    /**
     * List all published articles for n8n/agent use.
     * Full body included; no subscription or user context. Paginated.
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
}
