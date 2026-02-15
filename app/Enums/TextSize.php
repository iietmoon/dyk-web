<?php

namespace App\Enums;

enum TextSize: string
{
    case Small = 'small';
    case Medium = 'medium';
    case Large = 'large';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
