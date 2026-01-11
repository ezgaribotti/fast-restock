<?php

namespace Modules\Shipments\src\Enums;

enum TrackingStatusName: string
{
    case Unpaid = 'unpaid';
    case Unassigned = 'unassigned';
    case Assigned = 'assigned';
    case InTransit = 'in_transit';
    case Canceled = 'canceled';
    case Delivered = 'delivered';
}
