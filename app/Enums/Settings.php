<?php

namespace App\Enums;

enum Settings: string
{
    case DIPLOMA_STORAGE_PATH = 'private/diplomas';
    case PASSPORT_STORAGE_PATH = 'private/passports';

    // db settings names
    case PAYMENT_AMOUNT = 'payment_amount';
    case ZOOM_URL = 'zoom_url';

    public function defaultValue()
    {
        return match ($this) {
            self::PAYMENT_AMOUNT => 500000,
            self::ZOOM_URL => '',
        };
    }
}