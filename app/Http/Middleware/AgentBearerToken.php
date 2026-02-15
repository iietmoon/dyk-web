<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatusCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgentBearerToken
{
    /**
     * Handle an incoming request.
     * Verifies Bearer token against AGENT_ACCESS_TOKEN from .env (no database).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $expected = config('services.agent.access_token');

        if (empty($expected)) {
            return HttpStatusCode::InternalServerError->toResponse([
                'message' => 'Agent access token not configured.',
            ]);
        }

        if (! $token || ! hash_equals($expected, $token)) {
            return HttpStatusCode::Unauthorized->toResponse();
        }

        return $next($request);
    }
}
