<?php

namespace Modules\Orders\src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Orders\src\Entities\Order;

class OrderPaid extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public bool $shippingPaid)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order paid',
        );
    }

    public function content(): Content
    {
        $currency = config('stripe.currency');

        return new Content(
            view: 'orders::emails.order-paid',
            with: [
                'order_id' => $this->order->id,
                'tracking_code' => $this->order->tracking_code,
                'total_paid' => $this->order->payment->total_amount,
                'shipping_paid' => $this->shippingPaid,
                'currency' => strtoupper($currency),
                'date' => now()->toDateTimeString(),
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
