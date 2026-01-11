<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Shipments\src\Entities\TrackingStatus;
use Modules\Shipments\src\Enums\TrackingStatusName;

interface TrackingStatusRepositoryInterface extends RepositoryInterface
{
    public function findByName(TrackingStatusName $name): TrackingStatus;
}
