<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Inventory\database\Factories\PurchaseOrderFactory;
use Modules\Inventory\src\Enums\PurchaseOrderStatus;

class PurchaseOrder extends Entity
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'supplier_id',
        'status',
        'quantity',
        'unit_cost',
        'ordered_at',
        'received_at',
    ];

    protected $casts = [
        'status' => PurchaseOrderStatus::class,
    ];

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    protected static function newFactory(): object
    {
        return PurchaseOrderFactory::new();
    }
}
