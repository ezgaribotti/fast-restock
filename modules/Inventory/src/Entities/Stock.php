<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Inventory\database\Factories\StockFactory;

class Stock extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'quantity',
        'picking_location',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function newFactory(): object
    {
        return StockFactory::new();
    }
}
