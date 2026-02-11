# API v1

Base URL: `/api/v1`

All successful responses use this shape:

```json
{
  "code": 200,
  "message": "OK",
  "data": { ... }
}
```

Errors use `code` (e.g. 401, 422) and may include an `errors` object for validation.

---

## Public (no auth)

### Request OTP (send login code to email)

**POST** `/api/v1/authenticate`

Sends a 4-digit OTP to the given email. OTP expires in 10 minutes (configurable).

**Body (JSON):**

| Field  | Type   | Required | Description |
|--------|--------|----------|-------------|
| email  | string | yes      | Valid email address |

**Success (200):**

```json
{
  "code": 200,
  "message": "OTP sent to your email."
}
```

**Validation error (422):**

```json
{
  "code": 422,
  "message": "Unprocessable Entity",
  "errors": {
    "email": ["The email field is required."]
  }
}
```

---

### Verify OTP and get token

**POST** `/api/v1/verify-otp`

Verifies the OTP, creates or finds the user, and returns a Bearer token. Use the token in the `Authorization: Bearer <token>` header for protected routes.

**Body (JSON):**

| Field | Type   | Required | Description                          |
|-------|--------|----------|--------------------------------------|
| email | string | yes      | Same email used in authenticate      |
| otp   | string | yes      | 4-character OTP from email          |

**Success (200):**

```json
{
  "code": 200,
  "message": "OTP verified successfully.",
  "data": {
    "token": "1|abc123...",
    "user": { "id": "...", "name": "...", "email": "...", ... },
    "is_new_user": false
  }
}
```

**Validation / invalid or expired OTP (422):**

```json
{
  "code": 422,
  "message": "Unprocessable Entity",
  "errors": {
    "otp": ["Invalid OTP."]
  }
}
```

Or when OTP has expired: `"otp": ["OTP expired."]`

---

## Protected (Bearer token required)

Send header: `Authorization: Bearer <token>` (token from verify-otp).

### Get current user

**GET** `/api/v1/me`

**Success (200):**

```json
{
  "code": 200,
  "message": "OK",
  "data": { "id": "...", "name": "...", "email": "...", ... }
}
```

**Unauthorized (401):** Missing or invalid token.

---

### Update profile

**POST** `/api/v1/update-profile`

**Body (JSON):**

| Field    | Type  | Required | Description        |
|----------|-------|----------|--------------------|
| name     | string| yes      | Max 255             |
| birthdate| string| yes      | Date (e.g. Y-m-d)   |
| gender   | string| yes      | Max 255             |
| topics   | array | yes      | Array of topic IDs  |

**Success (200):**

```json
{
  "code": 200,
  "message": "Profile updated successfully.",
  "data": { "user": { ... } }
}
```

---

### Finish registration

**POST** `/api/v1/finish-registration`

Same body as **Update profile**. Use after first login when `is_new_user` was true to set name, birthdate, gender, and topics.

**Success (200):**

```json
{
  "code": 200,
  "message": "Registration finished successfully.",
  "data": { "user": { ... } }
}
```

---

### Logout

**POST** `/api/v1/logout`

Revokes all tokens for the current user. After this, the Bearer token can no longer be used.

**Success (200):**

```json
{
  "code": 200,
  "message": "Logged out successfully."
}
```

**Unauthorized (401):** Missing or invalid token.

---

### Create payment link

**POST** `/api/v1/payment/create-link`

Creates a one-time payment link for the authenticated user and the given plan. The link can be opened in a browser to complete payment. Link expires in 60 minutes.

**Body (JSON):**

| Field   | Type   | Required | Description                    |
|---------|--------|----------|--------------------------------|
| plan_id | string | yes      | UUID of an active plan        |

**Success (201):**

```json
{
  "code": 201,
  "message": "Payment link created.",
  "data": {
    "token": "...",
    "payment_link": "https://example.com/payment?token=...",
    "plan": { "id": "...", "name": "...", ... },
    "expires_in_minutes": 60
  }
}
```

**Validation error (422):**

```json
{
  "code": 422,
  "message": "Unprocessable Entity",
  "errors": {
    "plan_id": ["The plan id field is required."]
  }
}
```

**Plan not found or inactive (404):**

```json
{
  "code": 404,
  "message": "Not Found",
  "errors": {
    "plan_id": ["Plan not found or inactive."]
  }
}
```

**Unauthorized (401):** Missing or invalid token.

---

## Auth errors

- **401 Unauthorized:** No `Authorization: Bearer <token>` or token invalid/expired. Response: `{ "code": 401, "message": "Unauthorized" }`.
