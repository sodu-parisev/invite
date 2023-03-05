<?php

namespace App\Enums;

enum FormOfAttendance: string
{
    case Online = 'online';
    case Offline = 'offline';

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::Online => __('Online'),
            self::Offline => __('Offline'),
        };
    }

    public static function getDropdownOptions(): array
    {
        $options = [];
        foreach ([self::Online, self::Offline] as $option) {
            $options[$option->value] = $option->label();
        }
        return $options;
    }
}