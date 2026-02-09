<?php

use App\Enums\HttpStatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

if (! function_exists('generate_signed_token')) {
    /**
     * Generate a random cryptographically signed token.
     * The token can be verified with verify_signed_token() to ensure it was issued by this app.
     *
     * @param  int  $length  Length of the random token part (default 64).
     * @param  int|null  $expiryMinutes  Optional expiry in minutes from now (null = no expiry).
     * @return string Signed token (safe to pass in URLs/headers).
     */
    function generate_signed_token(int $length = 64, ?int $expiryMinutes = null): string
    {
        $token = Str::random($length);
        $payload = $expiryMinutes !== null
            ? $token . '.' . (time() + $expiryMinutes * 60)
            : $token;
        $signature = hash_hmac('sha256', $payload, config('app.key'));

        return base64_encode($payload . '.' . $signature);
    }
}

if (! function_exists('verify_signed_token')) {
    /**
     * Verify a signed token issued by generate_signed_token().
     *
     * @param  string  $signedToken  The signed token string.
     * @return array{token: string, expires_at: \DateTimeImmutable|null}|null  Decoded data or null if invalid/expired.
     */
    function verify_signed_token(string $signedToken): ?array
    {
        $decoded = base64_decode($signedToken, true);
        if ($decoded === false) {
            return null;
        }

        $parts = explode('.', $decoded);
        if (count($parts) === 2) {
            $token = $parts[0];
            $signature = $parts[1];
            $payload = $token;
            $expiresAt = null;
        } elseif (count($parts) === 3) {
            $token = $parts[0];
            $expiresAt = (int) $parts[1];
            $signature = $parts[2];
            $payload = $token . '.' . $parts[1];
            if (time() >= $expiresAt) {
                return null;
            }
        } else {
            return null;
        }

        $expected = hash_hmac('sha256', $payload, config('app.key'));
        if (! hash_equals($expected, $signature)) {
            return null;
        }

        return [
            'token' => $token,
            'expires_at' => $expiresAt !== null ? new \DateTimeImmutable('@' . $expiresAt) : null,
        ];
    }
}

if (! function_exists('api_response')) {
    /**
     * Structured API response using HttpStatusCode.
     * Pass a code (e.g. 200, 401) or an HttpStatusCode enum; optional extra keys merged into body.
     *
     * @param  int|HttpStatusCode  $code   HTTP status code or enum case.
     * @param  array<string, mixed>  $extra  Optional keys to merge (e.g. ['data' => $resource]).
     * @return JsonResponse
     */
    function api_response(int|HttpStatusCode $code, array $extra = []): JsonResponse
    {
        $status = $code instanceof HttpStatusCode
            ? $code
            : HttpStatusCode::fromCode($code);

        if ($status === null) {
            $status = HttpStatusCode::InternalServerError;
        }

        return $status->toResponse($extra);
    }
}
