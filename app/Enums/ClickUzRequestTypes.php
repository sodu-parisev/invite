<?php

namespace App\Enums;

enum ClickUzRequestTypes: string
{
    case Complete = 'complete';
    case Prepare = 'prepare';
}