<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Shipments\src\Entities\TrackingStatus;

interface TrackingStatusRepositoryInterface extends RepositoryInterface
{
    public function findByName(string $name): TrackingStatus;
}
