<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\database\Factories\StockRuleFactory;

class StockRule extends Entity
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'alert_threshold',
        'capacity_limit',
        'optimum_quantity',
    ];

    protected static function newFactory(): object
    {
        return StockRuleFactory::new();
    }
}
