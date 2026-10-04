<?php

namespace Modules\Order\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Common\src\Entities\Stock;
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

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    protected static function newFactory(): object
    {
        return OrderItemFactory::new();
    }
}
