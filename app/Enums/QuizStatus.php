<?php

namespace App\Enums;

enum QuizStatus: string
{
    case ACTIVE = 'active';

    case INACTIVE = 'inactive';

    public static function values(): array
    {
        $values = [];
        foreach (QuizStatus::cases() as $case) {
            $values[] = $case->value;
        }
        return $values;
    }

    public static function toArray()
    {
        $array = [];
        foreach (QuizStatus::cases() as $case) {
            $array[$case->value] = $case->name;
        }

        return $array;
    }

    public static function random(): QuizStatus
    {
        $array = QuizStatus::cases();
        $rand = collect($array)->random();
        return $rand;
    }
}
