<?php

namespace Modules\Shipments\database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\src\Entities\Order;
use Modules\Shipments\src\Entities\InsurancePolicy;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\TrackingStatus;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'tracking_status_id' => TrackingStatus::factory(),
            'insurance_policy_id' => InsurancePolicy::factory(),
            'weight' => fake()->randomDecimal(),
            'final_cost' => fake()->randomDecimal(),
            'coordinates' => json_encode([]),
            'departure_at' => fake()->dateTime(),
            'arrival_at' => fake()->dateTime(),
        ];
    }
}
