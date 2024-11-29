<?php

namespace App\Enums;

use function Symfony\Component\String\s;

enum TypeNumbers: string
{
    case MOBILE = "mobile";
    case HOME = "home";
    case WORK = "work";
    case SCHOOL = "school";
    case OTHER = "other";

    public static function getTypeNumbersDescription(): array
    {
        return [
            [ "title" => 'Мобильный', "value" => self::MOBILE->value ],
            [ "title" => 'Домашний', "value" => self::HOME->value ],
            [ "title" => 'Рабочий', "value" => self::WORK->value ],
            [ "title" => 'Учебный', "value" => self::SCHOOL->value ],
            [ "title" => 'Другой', "value" => self::OTHER->value ]
        ];
    }

    public static function getTypeNumber(string $value): string
    {
        switch ($value) {
            case self::MOBILE->value: return "Мобильный";
            case self::HOME->value: return "Домашний";
            case self::WORK->value: return "Рабочий";
            case self::SCHOOL->value: return "Учебный";
            case self::OTHER->value: return "Другой";
            default: return "Неизвестно";
        }
    }
}
