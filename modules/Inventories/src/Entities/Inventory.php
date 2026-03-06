<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Inventories\database\Factories\InventoryFactory;

class Inventory extends Entity
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'stock',
        'alert_threshold',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    protected static function newFactory(): object
    {
        return InventoryFactory::new();
    }
}
