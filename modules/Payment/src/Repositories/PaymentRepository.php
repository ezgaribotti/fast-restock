<?php

namespace Modules\Payment\src\Repositories;

use App\Repositories\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Payment\src\Entities\Payment;
use Modules\Payment\src\Enums\PaymentStatus;
use Modules\Payment\src\Interfaces\PaymentRepositoryInterface;

class PaymentRepository extends Repository implements PaymentRepositoryInterface
{
    public function __construct(Payment $entity)
    {
        parent::__construct($entity);
    }

    public function claimPaymentsToVerify(int $limit = 5): Collection
    {
        return DB::transaction(function () use ($limit) {
            $payments = $this->entity
                ->whereStatus(PaymentStatus::Pending)
                ->whereLockedAt(null)->lockForUpdate()->limit($limit)->get();

            foreach ($payments as $payment) {
                $payment->locked_at = now();

                // Lock to prevent concurrent updates
                $this->update($payment);
            }
            return $payments;
        });
    }
}
