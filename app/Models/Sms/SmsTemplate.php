<?php

namespace App\Models\Sms;

use App\Enums\Sms\SmsTemplateType;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    const TAG_FIRST_NAME = '[[Ime]]';
    const TAG_LAST_NAME = '[[Prezime]]';
    const TAG_COMPANY_NAME = '[[Firma]]';
    
    protected $fillable = [
        'company_id',
        'type',
        'text',
        'description'
    ];

    public function replaceTags(Order $order): string
    {
        $text = $this->text;

        $text = str_replace(self::TAG_FIRST_NAME, $order->first_name, $text);
        $text = str_replace(self::TAG_LAST_NAME, $order->last_name, $text);
        $text = str_replace(self::TAG_COMPANY_NAME, $order->company->name, $text);

        return $text;
    }

    public function getTypeFormatted(): string
    {
        switch ($this->type) {
            case SmsTemplateType::OrderReceived->value:
                return 'porudžbina primljena';
        }
    }
}
