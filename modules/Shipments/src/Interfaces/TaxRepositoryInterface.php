<?php

namespace Modules\Shipments\src\Interfaces;

use App\Interfaces\RepositoryInterface;

interface TaxRepositoryInterface extends RepositoryInterface
{
    public function sumTaxRateByCountryId(int $countryId): float;
}
