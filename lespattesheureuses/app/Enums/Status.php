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
            'trad' => $option->label()
        ], self::cases());
    }

    public function label()
    {
        return match ($this) {
            self::ADOPTABLE => __('animals_status_enum.adoptable'),
            self::ADOPTED => __('animals_status_enum.adopted'),
            self::IN_CARE => __('animals_status_enum.in_care'),
            self::UNAVAILABLE => __('animals_status_enum.unavailable'),
            self::PENDING => __('animals_status_enum.pending'),
        };
    }
}
