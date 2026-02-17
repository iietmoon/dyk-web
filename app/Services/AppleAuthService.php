<?php

namespace App\Services;

use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use stdClass;

class AppleAuthService
{
    private const JWKS_URI = 'https://appleid.apple.com/auth/keys';

    private const ISSUER = 'https://appleid.apple.com';

    private const JWKS_CACHE_TTL_SECONDS = 86400; // 24 hours

    /**
     * Verify a Sign in with Apple identity token and return the payload.
     * Payload contains at least: sub (required), email (optional), email_verified (optional).
     *
     * @return array{sub: string, email?: string, email_verified?: string}
     * @throws InvalidArgumentException when token is invalid or client_id not configured
     */
    public function verifyIdToken(string $identityToken): array
    {
        $clientId = config('services.apple.client_id');
        if (empty($clientId)) {
            throw new InvalidArgumentException('Apple Client ID is not configured.');
        }

        $keys = $this->fetchApplePublicKeys();
        $payload = $this->decodeAndVerify($identityToken, $keys);

        if (empty($payload->sub ?? null)) {
            throw new InvalidArgumentException('Apple identity token does not contain subject (sub).');
        }

        if ($payload->iss !== self::ISSUER) {
            throw new InvalidArgumentException('Invalid Apple token issuer.');
        }

        if ($payload->aud !== $clientId) {
            throw new InvalidArgumentException('Apple token audience does not match this app.');
        }

        $result = [
            'sub' => $payload->sub,
        ];
        if (! empty($payload->email)) {
            $result['email'] = $payload->email;
            $result['email_verified'] = $payload->email_verified ?? 'false';
        }

        return $result;
    }

    /**
     * @param  array<string, \Firebase\JWT\Key>  $keys
     * @return stdClass payload
     */
    private function decodeAndVerify(string $jwt, array $keys): stdClass
    {
        try {
            $payload = JWT::decode($jwt, $keys);
        } catch (\Throwable $e) {
            throw new InvalidArgumentException('Invalid or expired Apple identity token: ' . $e->getMessage());
        }

        return $payload;
    }

    /**
     * @return array<string, \Firebase\JWT\Key>
     */
    private function fetchApplePublicKeys(): array
    {
        $jwks = Cache::remember('apple_jwks', self::JWKS_CACHE_TTL_SECONDS, function () {
            $response = Http::timeout(10)->get(self::JWKS_URI);

            if (! $response->successful()) {
                throw new InvalidArgumentException('Failed to fetch Apple public keys.');
            }

            $data = $response->json();
            if (empty($data['keys'])) {
                throw new InvalidArgumentException('Invalid Apple JWKS response.');
            }

            return $data;
        });

        return JWK::parseKeySet($jwks, 'RS256');
    }
}
