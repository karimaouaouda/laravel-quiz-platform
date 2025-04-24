<?php

namespace App\Enums;

enum DifficultyLevel : string
{
    case EASY = 'easy';
    case HARD = 'hard';
    case MEDIUM = 'medium';


    public static function toArray($reversed = false): array
    {
        $arr = [];
        foreach (DifficultyLevel::cases() as $case) {
            if($reversed) {
                $arr[$case->value] = $case->name;
            }else{
                $arr[$case->name] = $case->value;
            }
        }

        return $arr;
    }
}
