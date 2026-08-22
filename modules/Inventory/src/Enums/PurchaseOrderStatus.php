<?php

namespace Modules\Inventory\src\Enums;

enum PurchaseOrderStatus: string
{
    case Pending = 'pending';
    case Ordered = 'ordered';
    case Rejected = 'rejected';
    case Received = 'received';
}
