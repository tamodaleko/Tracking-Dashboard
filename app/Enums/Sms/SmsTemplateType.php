<?php

declare(strict_types=1);

namespace App\Enums\Sms;

enum SmsTemplateType: string
{
    case OrderReceived = 'order_received';
}
