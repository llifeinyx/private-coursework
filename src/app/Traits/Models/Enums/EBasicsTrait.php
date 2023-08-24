<?php

namespace App\Traits\Models\Enums;

trait EBasicsTrait {
    public static function __callStatic($enum, $args)
    {
        return self::values()[$enum];
    }
    public static function values()
    {
        return collect(self::cases())->mapWithKeys(function ($enum) {
            return [$enum->name => $enum->value];
        })->toArray();
    }
}
