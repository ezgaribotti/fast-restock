<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventories\database\Factories\InventoryAdjustmentFactory;

class InventoryAdjustment extends Entity
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'quantity',
        'is_incoming',
    ];

    protected static function newFactory(): object
    {
        return InventoryAdjustmentFactory::new();
    }
}
