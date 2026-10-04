<?php

namespace Modules\Payment\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Illuminate\Support\Collection;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function claimPaymentsToVerify(int $limit = 5): Collection;
}
