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
}
