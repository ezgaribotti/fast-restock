<?php

namespace Modules\Shipments\src\Listeners;

use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class PrepareShipment
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
    )
    {
    }

    public function handle(object $event): void
    {
        $shipment = $this->shipmentRepository->findByOrderId($event->order->id);
        if (!$shipment || $shipment->trackingStatus->name != 'unpaid') {

            // Orders can only be updated once
            return;
        }
        $trackingStatus = $this->trackingStatusRepository->findByName('unassigned');
        $this->shipmentRepository->update($shipment->id, [
            'tracking_status_id' => $trackingStatus->id]);
    }
}
