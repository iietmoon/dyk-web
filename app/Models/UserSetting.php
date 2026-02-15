<?php

namespace App\Models;

use App\Enums\AppearanceMode;
use App\Enums\TextSize;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetting extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'text_size',
        'appearance_mode',
        'daily_reminder_notification',
        'best_fact_notification',
    ];

    protected function casts(): array
    {
        return [
            'text_size' => TextSize::class,
            'appearance_mode' => AppearanceMode::class,
            'daily_reminder_notification' => 'boolean',
            'best_fact_notification' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
