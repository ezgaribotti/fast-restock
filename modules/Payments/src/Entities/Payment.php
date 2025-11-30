<?php

namespace Modules\Payments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Enums\PaymentStatus;
use Modules\Payments\database\Factories\PaymentFactory;

class Payment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'status',
        'tracking_code',
        'session_id',
        'url',
        'hosted_invoice_url',
        'total_amount',
        'expires_at',
        'paid_at',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];

    protected static function newFactory(): object
    {
        return PaymentFactory::new();
    }
}
