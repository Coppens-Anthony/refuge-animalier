<?php

namespace App\Enums;

enum Members: string
{
    case ADMINISTRATOR = 'administrator';
    case VOLUNTEER = 'volunteer';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }

    public static function options(): array
    {
        return array_map(fn($option) => [
            'value' => $option->value,
            'trad' => $option->label()
        ], self::cases());
    }

    public function label()
    {
        return match ($this) {
            self::VOLUNTEER => __('admin/global.volunteer'),
            self::ADMINISTRATOR => __('admin/global.admin'),
        };
    }
}
