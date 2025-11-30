<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\database\Factories\CustomerFactory;
use Modules\Customers\src\Enums\CustomerStatus;

class Customer extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'email',
        'full_phone',
    ];

    public function addresses(): object
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
