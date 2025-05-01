<?php

namespace App\Enums;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

enum QuestionType: string
{
    case MULTIPLE_CHOICE = 'multiple_choice';
    case TRUE_FALSE = 'true_false';

    case ONE_CHOICE = 'one_choice';


    public static function values(): array
    {
        $values = [];

        foreach (static::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public static function toArray()
    {
        $arr = [];
        foreach (static::cases() as $case) {
            $arr[$case->value] = Str::replace("_", " ", $case->name);
        }

        return $arr;
    }
}
