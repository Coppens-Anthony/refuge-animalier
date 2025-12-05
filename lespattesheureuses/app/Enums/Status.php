<?php

namespace App\Enums;

enum Status: string
{
    case ADOPTABLE = 'adoptable';
    case ADOPTED = 'adopted';
    case IN_CARE = 'in_care';
    case UNAVAILABLE = 'unavailable';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
