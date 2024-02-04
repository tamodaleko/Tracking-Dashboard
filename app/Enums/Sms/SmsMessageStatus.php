<?php

declare(strict_types=1);

namespace App\Enums\Sms;

enum SmsMessageStatus: string
{
    case Sent = 'sent';
    case Delivered = 'delivered';
    case Undelivered = 'undelivered';
    case Failed = 'failed';
}
