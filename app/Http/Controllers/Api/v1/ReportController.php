<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\HttpStatusCode;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Report / signal a problem on an article (e.g. inappropriate content, error). Requires motif (reason).
     *
     * @group Reports
     * @bodyParam article_id string required UUID of the article being reported. Example: 9d4e8f2a-1b3c-4d5e-6f7a-8b9c0d1e2f3a
     * @bodyParam motif string required Reason/category of the problem. Example: inappropriate_content
     * @bodyParam details string optional Extra description. Example: The image in section 2 is offensive.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'article_id' => ['required', 'uuid', 'exists:articles,id'],
            'motif' => ['required', 'string', 'max:255'],
            'details' => ['sometimes', 'nullable', 'string', 'max:2000'],
        ], [
            'article_id.exists' => 'The selected article does not exist.',
        ]);

        if ($validator->fails()) {
            return HttpStatusCode::UnprocessableEntity->toResponse([
                'errors' => $validator->errors(),
            ]);
        }

        $user = $request->user();

        $report = Report::create([
            'user_id' => $user->id,
            'article_id' => $request->input('article_id'),
            'motif' => $request->input('motif'),
            'details' => $request->input('details'),
        ]);

        $report->load('article:id,title,slug');

        return HttpStatusCode::Created->toResponse([
            'message' => 'Report submitted. Thank you for your feedback.',
            'data' => $report,
        ]);
    }
}
