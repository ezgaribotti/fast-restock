<?php

namespace Modules\Shipments\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Shipments\src\Entities\Shipment;

class ShipmentSynced extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Shipment $shipment)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Shipment synchronized',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'shipments::emails.shipment-synced',
            with: [
                'shipment_id' => $this->shipment->id,
                'tracking_code' => $this->shipment->order->tracking_code,
                'status' => strtoupper($this->shipment->trackingStatus->name),
                'date' => $this->shipment->updated_at,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
