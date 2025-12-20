<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\src\Entities\Country;
use Modules\Inventories\database\Factories\SupplierFactory;

class Supplier extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'country_id',
    ];

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory(): object
    {
        return SupplierFactory::new();
    }
}
