<?php

namespace App\Enums;

enum Adoptions: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case FINISHED = 'finished';

    case ARCHIVED = 'archived';

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
            self::IN_PROGRESS => __('admin/global.in_progress'),
            self::FINISHED => __('admin/global.finished'),
            self::ARCHIVED => __('admin/global.archived'),
            self::PENDING => __('animals_status_enum.pending'),
        };
    }
}
