<?php

namespace App\Enums;

enum UserRoles: string
{
    case TEACHER = 'teacher';
    case STUDENT = 'student';

    case ADMIN = 'admin';

    public static function toArray()
    {
        $array = [];
        foreach (staic::cases() as $case) {
            $array[$case->value] = $case->name;
        }

        return $array;
    }

    public static function values(): array
    {
        $values = [];
        foreach (UserRoles::cases() as $case) {
            $values[] = $case->value;
        }
        return $values;
    }
}
