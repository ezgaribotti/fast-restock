<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Shipments\src\Entities\TrackingStatus;
use Modules\Shipments\src\Enums\TrackingStatusName;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class TrackingStatusRepository extends Repository implements TrackingStatusRepositoryInterface
{
    public function __construct(TrackingStatus $entity)
    {
        parent::__construct($entity);
    }

    public function findByName(TrackingStatusName $name): TrackingStatus
    {
        return $this->entity->whereName($name)->firstOrFail();
    }
}
