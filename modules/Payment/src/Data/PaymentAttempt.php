<?php

namespace Modules\Payment\src\Data;

use App\Data\Data;
use Carbon\CarbonInterface;
use Modules\Payment\src\Enums\PaymentStatus;

class PaymentAttempt extends Data
{
    public string $referenceId;
    public float $totalAmount;
    public string $url;
    public PaymentStatus $status;
    public ?CarbonInterface $paidAt = null;
}
