# Authenticating requests

To authenticate requests, include an **`Authorization`** header with the value **`"Bearer {YOUR_BEARER_TOKEN}"`**.

All authenticated endpoints are marked with a `requires authentication` badge in the documentation below.

Send a **POST** request to **/api/v1/authenticate** with your email to receive an OTP, then **POST** to **/api/v1/verify-otp** with `email` and `otp` to get your Bearer token. Use it in the header: `Authorization: Bearer <token>`.
