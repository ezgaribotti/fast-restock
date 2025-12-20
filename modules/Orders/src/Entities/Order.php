<?php

namespace Modules\Orders\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Common\src\Entities\Country;
use Modules\Common\src\Entities\CustomerAddress;
use Modules\Common\src\Entities\Payment;
use Modules\Common\src\Entities\Product;
use Modules\Orders\database\Factories\OrderFactory;

class Order extends Entity
{
    use HasFactory;

    protected $fillable = [
        'tracking_code',
        'country_id',
        'customer_address_id',
        'total_amount',
        'weight',
        'payment_id',
    ];

    public function country(): object
    {
        return $this->belongsTo(Country::class);
    }

    public function customerAddress(): object
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function products(): object
    {
        return $this->belongsToMany(Product::class)->withPivot([
            'fixed_price',
            'quantity'
        ]);
    }

    public function payment(): object
    {
        return $this->belongsTo(Payment::class);
    }

    protected static function newFactory(): object
    {
        return OrderFactory::new();
    }
}
