<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Failed = 'failed';
    case Completed = 'completed';

    public function label(): string {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::Pending => __('Pending'),
            self::Failed => __('Failed'),
            self::Completed => __('Completed'),
        };
    }
}