<?php

namespace Modules\Shipments\src\Repositories;

use App\Repositories\Repository;
use Modules\Common\src\Entities\Country;
use Modules\Shipments\src\Interfaces\CountryRepositoryInterface;

class CountryRepository extends Repository implements CountryRepositoryInterface
{
    public function __construct(Country $entity)
    {
        parent::__construct($entity);
    }
}
