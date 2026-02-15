<?php

namespace App\Enums;

enum AppearanceMode: string
{
    case Light = 'light';
    case Dark = 'dark';
    case System = 'system';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
