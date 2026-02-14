# Introduction

API v1 for authentication (OTP), profile, and payments.

<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>

    Base URL: `/api/v1`. All successful responses use `{ "code": 200, "message": "...", "data": { ... } }`. Errors use `code` (e.g. 401, 422) and may include an `errors` object for validation.

    **Authentication:** Public endpoints (request OTP, verify OTP) require no auth. Protected endpoints require `Authorization: Bearer <token>` where the token is returned from **POST /api/v1/verify-otp**.

