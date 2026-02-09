<?php

namespace App\Http\Middleware;

use App\Enums\HttpStatusCode;
use App\Models\PersonalAccessToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthetication
{
    /**
     * Handle an incoming request.
     * Validates Bearer token against personal_access_tokens and sets the user when valid.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $this->getTokenFromRequest($request);

        if (! $token) {
            return HttpStatusCode::Unauthorized->toResponse();
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (! $accessToken || ($accessToken->expires_at && $accessToken->expires_at->isPast())) {
            return HttpStatusCode::Unauthorized->toResponse();
        }

        $request->setUserResolver(fn () => $accessToken->tokenable);

        return $next($request);
    }

    private function getTokenFromRequest(Request $request): ?string
    {
        return $request->bearerToken();
    }
}
