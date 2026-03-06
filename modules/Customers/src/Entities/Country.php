<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\Scopes\IsActiveScope;
use Modules\Customers\database\Factories\CountryFactory;

class Country extends Entity
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new IsActiveScope());
    }

    protected static function newFactory(): object
    {
        return CountryFactory::new();
    }
}
