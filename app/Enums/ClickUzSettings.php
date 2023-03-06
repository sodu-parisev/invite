<?php

namespace App\Enums;

enum ClickUzSettings: string
{
    case BASE_URL = 'https://my.click.uz/services/pay';
    case SERVICE_ID = '123123';
    case MERCHANT_ID = '234234';
}