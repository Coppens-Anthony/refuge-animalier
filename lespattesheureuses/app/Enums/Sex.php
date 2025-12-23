<?php

namespace App\Enums;

enum Sex: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public static function values(): array
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
            self::MALE => __('client/animals.male'),
            self::FEMALE => __('client/animals.female'),
        };
    }
}
