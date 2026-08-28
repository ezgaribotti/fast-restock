<?php

namespace Modules\Payment\src\Enums;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
}
