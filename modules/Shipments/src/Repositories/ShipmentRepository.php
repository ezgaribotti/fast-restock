<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;

class ShipmentRepository extends Repository implements ShipmentRepositoryInterface
{
    public function __construct(Shipment $entity)
    {
        parent::__construct($entity);
    }

    public function findByOrderId(int $orderId): ?Shipment
    {
        return $this->entity->whereOrderId($orderId)->first();
    }
}
