<?php

namespace Modules\Order\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Order\database\Factories\OrderItemFactory;

class OrderItem extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'stock_id',
        'quantity',
        'unit_sale_price',
    ];

    protected static function newFactory(): object
    {
        return OrderItemFactory::new();
    }
}
