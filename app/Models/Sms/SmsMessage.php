<?php

namespace App\Models\Sms;

use App\Models\Company;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsMessage extends Model
{
    protected $casts = [
        'company_id' => 'int',
        'order_id' => 'int',
        'template_id' => 'int',
        'delivered_at' => 'datetime',
        'clicked_at' => 'datetime',
    ];
    
    protected $fillable = [
        'company_id',
        'order_id',
        'template_id',
        'route',
        'message_id',
        'text',
        'delivered_at',
        'clicked_at',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(SmsTemplate::class, 'template_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
