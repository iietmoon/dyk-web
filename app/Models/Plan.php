<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'provider',
        'provider_product_id',
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'billing_cycle',
        'capabilities',
        'is_active',
        'is_featured',
        'sort_order',
        'has_trial',
        'trial_days',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'has_trial' => 'boolean',
            'trial_days' => 'integer',
            'capabilities' => 'array',
        ];
    }

    /**
     * Get the subscriptions for the plan.
     *
     * @return HasMany<Subscription, $this>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the transaction tokens created for this plan.
     *
     * @return HasMany<TransactionToken, $this>
     */
    public function transactionTokens(): HasMany
    {
        return $this->hasMany(TransactionToken::class);
    }
}
