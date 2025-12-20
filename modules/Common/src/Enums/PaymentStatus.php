<?php

namespace Modules\Common\src\Enums;

enum PaymentStatus: string
{
    case InProgress = 'in_progress';
    case Paid = 'paid';
    case Canceled = 'canceled';
}
