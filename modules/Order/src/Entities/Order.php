<?php

namespace Modules\Order\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Order\database\Factories\OrderFactory;

class Order extends Entity
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'customer_id',
        'total_amount',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function newFactory(): object
    {
        return OrderFactory::new();
    }
}
