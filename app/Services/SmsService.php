<?php

namespace App\Services;

use App\Enums\Sms\SmsMessageRoute;
use App\Enums\Sms\SmsMessageStatus;
use App\Enums\Sms\SmsTemplateType;
use App\Models\Order\Order;
use App\Models\Sms\SmsMessage;
use App\Models\Sms\SmsTemplate;
use Exception;
use Illuminate\Support\Str;
use Throwable;
use Twilio\Rest\Client;

class SmsService
{
    const TEXT_LIMIT = 160;
    
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twillio.account_sid'),
            config('services.twillio.auth_token')
        );
    }

    public function send(SmsTemplateType $type, Order $order): bool
    {
        $template = SmsTemplate::where('type', $type)->first();

        if (!$template) {
            return false;
        }

        $text = $template->replaceTags($order);

        if (strlen($text) > self::TEXT_LIMIT) {
            return false;
        }

        $check = SmsMessage::where('order_id', $order->id)
            ->where('template_id', $template->id)
            ->exists();

        if ($check) {
            return false;
        }

        $message_id = $this->sendClient($order, $text);

        if (!$message_id) {
            return false;
        }

        SmsMessage::create([
            'route' => SmsMessageRoute::Twillio,
            'message_id' => $message_id,
            'order_id' => $order->id,
            'template_id' => $template->id,
            'text' => $text,
            'status' => SmsMessageStatus::Sent
        ]);

        return true;
    }

    private function sendClient(Order $order, string $text): string|bool
    {
        $phone = $this->formatPhone($order->phone);

        if (!$phone) {
            return false;
        }
        
        try {
            $send = $this->client->messages->create($phone, [
                'from' => SmsMessage::TWILLIO_NUMBER,
                'body' => $text,
                'statusCallback' => route('webhooks.twillio.delivery')
            ]);
            
            $data = $send->toArray();

            if (isset($data['sid']) && $data['sid']) {
                return $data['sid'];
            }
        } catch (Throwable $e) {
            report(new Exception($e->getMessage()));
        }
        
        return false;
    }

    private function formatPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (!in_array(strlen($phone), [11, 12])) {
            return false;
        }

        return $phone;
    }
}
