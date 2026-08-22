<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Inventory\database\Factories\SupplierFactory;

class Supplier extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
    ];

    protected static function newFactory(): object
    {
        return SupplierFactory::new();
    }
}
