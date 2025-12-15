<?php

namespace App\Enums;

enum Status: string
{
    case ADOPTABLE = 'adoptable';
    case ADOPTED = 'adopted';
    case IN_CARE = 'in_care';
    case UNAVAILABLE = 'unavailable';
    case PENDING = 'pending';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_map(fn($option) => [
            'value' => $option->value,
            'trad' => ucfirst($option->value)
        ], self::cases());
    }
}
