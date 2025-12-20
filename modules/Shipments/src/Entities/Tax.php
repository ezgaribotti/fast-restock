<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\src\Entities\Scopes\ActiveScope;
use Modules\Shipments\database\Factories\TaxFactory;

class Tax extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'country_id',
        'tax_rate',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope());
    }

    protected static function newFactory(): object
    {
        return TaxFactory::new();
    }
}
