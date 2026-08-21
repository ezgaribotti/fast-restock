<?php

namespace Modules\Customer\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customer\database\Factories\CustomerFactory;
use Modules\Customer\src\Enums\CustomerStatus;

class Customer extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'phone_number',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    protected $casts = [
        'status' => CustomerStatus::class,
    ];

    protected static function newFactory(): object
    {
        return CustomerFactory::new();
    }
}
