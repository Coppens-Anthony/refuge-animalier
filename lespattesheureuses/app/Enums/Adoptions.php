<?php

namespace App\Enums;

enum Adoptions: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

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
