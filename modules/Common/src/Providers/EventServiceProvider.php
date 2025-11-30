<?php

namespace Modules\Common\src\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Orders\src\Events\ShippingPaid;
use Modules\Shipments\src\Listeners\PrepareShipment;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ShippingPaid::class => [
            PrepareShipment::class,
        ]
    ];
}
