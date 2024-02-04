<?php

declare(strict_types=1);

namespace App\Enums\Sms;

enum SmsMessageRoute: string
{
    case Twillio = 'twillio';
}
