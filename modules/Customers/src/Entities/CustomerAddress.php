<?php

namespace Modules\Customers\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\database\Factories\CustomerAddressFactory;

class CustomerAddress extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'street_address',
        'city',
        'state',
        'postal_code',
        'country_id',
        'description'
    ];

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    public function customer(): object
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function newFactory(): object
    {
        return CustomerAddressFactory::new();
    }
}
