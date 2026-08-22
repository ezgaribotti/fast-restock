<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed below are automatically registered
    | allowing each module to load its own dedicated resources.
    |
    */

    'providers' => [
        Modules\Common\CommonServiceProvider::class,
        Modules\Auth\AuthServiceProvider::class,
        Modules\Customer\CustomerServiceProvider::class,
        Modules\Inventory\InventoryServiceProvider::class,
    ],

];
