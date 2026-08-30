<?php

namespace Modules\Payment\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\database\Factories\PaymentFactory;
use Modules\Payment\src\Enums\PaymentStatus;

class Payment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'reference_id',
        'status',
        'url',
        'total_amount',
        'paid_at',
        'locked_at',
    ];

    protected $casts = [
        'status' => PaymentStatus::class,
    ];

    protected static function newFactory(): object
    {
        return PaymentFactory::new();
    }
}
