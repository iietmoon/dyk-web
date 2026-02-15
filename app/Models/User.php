<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'gender',
        'topics',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthdate' => 'date',
            'password' => 'hashed',
            'topics' => 'array',
        ];
    }

    /**
     * Get the sessions for the user.
     *
     * @return HasMany<Session, $this>
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    /**
     * Get the password reset tokens for the user (by email).
     *
     * @return HasMany<PasswordResetToken, $this>
     */
    public function passwordResetTokens(): HasMany
    {
        return $this->hasMany(PasswordResetToken::class, 'email', 'email');
    }

    /**
     * Get the OTP records for the user (by email).
     *
     * @return HasMany<UserOtp, $this>
     */
    public function otps(): HasMany
    {
        return $this->hasMany(UserOtp::class, 'email', 'email');
    }

    /**
     * Get the subscriptions for the user.
     *
     * @return HasMany<Subscription, $this>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the user's latest active subscription (as a relationship for eager loading).
     *
     * @return HasOne<Subscription, $this>
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)
            ->where('status', 'active')
            ->ofMany(['created_at' => 'max']);
    }

    /**
     * Get the transactions for the user.
     *
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the transaction tokens for the user (payment links).
     *
     * @return HasMany<TransactionToken, $this>
     */
    public function transactionTokens(): HasMany
    {
        return $this->hasMany(TransactionToken::class);
    }

    /**
     * Get the user's article bookmarks.
     *
     * @return HasMany<ArticleBookmark, $this>
     */
    public function articleBookmarks(): HasMany
    {
        return $this->hasMany(ArticleBookmark::class);
    }

    /**
     * Get the user's settings (text size, appearance, notifications).
     *
     * @return HasOne<UserSetting, $this>
     */
    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class);
    }
}
