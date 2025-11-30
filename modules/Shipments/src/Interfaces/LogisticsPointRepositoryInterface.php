<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Shipments\src\Entities\LogisticsPoint;

interface LogisticsPointRepositoryInterface extends RepositoryInterface
{
    public function getByCountryId(int $countryId): LogisticsPoint;
}
