<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Shipments\src\Entities\Shipment;

interface ShipmentRepositoryInterface extends RepositoryInterface
{
    public function findByOrderId(int $orderId): ?Shipment;
}
