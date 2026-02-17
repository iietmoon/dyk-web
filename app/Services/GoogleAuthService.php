<?php

namespace App\Services;

use Google\Client as GoogleClient;
use InvalidArgumentException;

class GoogleAuthService
{
    /**
     * Verify a Google ID token (from mobile Sign-In) and return the payload.
     * Returns payload with at least: sub, email, email_verified, name, picture (optional).
     *
     * @return array{sub: string, email: string, email_verified: bool, name?: string, picture?: string}
     * @throws InvalidArgumentException when token is invalid or client_id not configured
     */
    public function verifyIdToken(string $idToken): array
    {
        $clientId = config('services.google.client_id');
        if (empty($clientId)) {
            throw new InvalidArgumentException('Google Client ID is not configured.');
        }

        $client = new GoogleClient(['client_id' => $clientId]);
        $payload = $client->verifyIdToken($idToken);

        if ($payload === false) {
            throw new InvalidArgumentException('Invalid or expired Google ID token.');
        }

        if (empty($payload['email'] ?? null)) {
            throw new InvalidArgumentException('Google ID token does not contain email.');
        }

        return $payload;
    }
}
