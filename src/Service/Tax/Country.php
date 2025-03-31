<?php

namespace App\Service\Tax;

enum Country: string
{
    case GERMANY = 'DE';
    case ITALY = 'IT';
    case GREECE = 'GR';
    case FRANCE = 'FR';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function formats(): array
    {
        return [
            self::GERMANY->value => '/^\d{9}$/',
            self::ITALY->value   => '/^\d{11}$/',
            self::GREECE->value  => '/^\d{9}$/',
            self::FRANCE->value  => '/^[A-Z]{2}\d{9}$/',
        ];
    }

    public static function rates(): array
    {
        return [
            self::GERMANY->value => 0.19,
            self::ITALY->value   => 0.22,
            self::GREECE->value  => 0.24,
            self::FRANCE->value  => 0.20,
        ];
    }
}