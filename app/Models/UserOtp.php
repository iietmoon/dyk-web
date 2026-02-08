<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserOtp extends Model
{
    protected $fillable = ['email', 'otp', 'expires_at', 'attempts'];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function isValid(): bool
    {
        return $this->expires_at->isFuture();
    }
}
