<?php

namespace App\Enums;

enum Sex: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    public static function values()
    {
        return array_column(self::cases(), 'value');
    }
}
