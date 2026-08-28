<?php

namespace Modules\Payment\src\Repositories;

use App\Repositories\Repository;
use Modules\Payment\src\Entities\Payment;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    public function __construct(Payment $entity)
    {
        parent::__construct($entity);
    }
}
