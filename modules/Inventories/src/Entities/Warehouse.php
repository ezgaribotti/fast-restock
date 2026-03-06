<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\src\Entities\Scopes\IsActiveScope;
use Modules\Inventories\database\Factories\WarehouseFactory;

class Warehouse extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new IsActiveScope());
    }

    protected static function newFactory(): object
    {
        return WarehouseFactory::new();
    }
}
