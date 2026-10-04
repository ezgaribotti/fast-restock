<?php

namespace Modules\Customer\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customer\database\Factories\CustomerAddressFactory;

class CustomerAddress extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'street_address',
        'city',
        'state',
        'postal_code',
        'observations',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    protected static function newFactory(): object
    {
        return CustomerAddressFactory::new();
    }
}
