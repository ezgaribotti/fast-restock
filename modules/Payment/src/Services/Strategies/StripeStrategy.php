<?php

namespace Modules\Payment\src\Services\Strategies;

use Modules\Payment\src\Data\PaymentAttempt;
use Modules\Payment\src\Enums\PaymentStatus;
use Modules\Payment\src\Interfaces\PaymentStrategyInterface;
use Stripe\Checkout\Session;
use Stripe\StripeClient;

class StripeStrategy implements PaymentStrategyInterface
{
    public readonly StripeClient $client;
    public string $currency;

    public function __construct()
    {
        $configKey = 'services.stripe';

        [$apiKey, $currency] = array_values(config($configKey));

        // Currency should ideally be dynamic, but it's fixed here for simplicity

        $this->currency = $currency;
        $this->client = new StripeClient($apiKey);
    }

    public function pay(array $lineItems, string $returnUrl): PaymentAttempt
    {
        // Each line must have the same order of values

        $lineItems = array_map(function ($lineItem) {
            [$quantity, $unitPrice, $productName] = $lineItem;

            return [
                'quantity' => $quantity,
                'price_data' => [
                    'currency' => $this->currency,
                    'product_data' => [
                        'name' => $productName,
                    ],
                    'unit_amount_decimal' => $unitPrice * 100,
                ],
            ];
        }, $lineItems);

        $mode = Session::MODE_PAYMENT; // One-time payment

        $session = $this->client->checkout->sessions->create([
            'mode' => $mode,
            'line_items' => $lineItems,
            'success_url' => $returnUrl,

            // To prevent them from paying whenever they want
            'expires_at' => now()->addMinutes(30)->getTimestamp(),
        ]);
        return $this->toAttempt($session);
    }

    public function retrieve(string $referenceId): PaymentAttempt
    {
        return $this->toAttempt($this->client->checkout->sessions->retrieve($referenceId));
    }

    public function expire(string $referenceId): void
    {
        $this->client->checkout->sessions->expire($referenceId);
    }

    private function toAttempt(Session $session): PaymentAttempt
    {
        $status = $session->payment_status === Session::PAYMENT_STATUS_PAID
            ? PaymentStatus::Paid : ($session->status === Session::STATUS_OPEN ? PaymentStatus::Pending : PaymentStatus::Expired);

        $attempt = new PaymentAttempt();

        $attempt->paidAt = $status === PaymentStatus::Paid ? now() : null;
        $attempt->status = $status;
        if ($status !== PaymentStatus::Pending) {

            // Nothing else needs to be done
            return $attempt;
        }

        $attempt->url = $session->url;
        $attempt->referenceId = $session->id;
        $attempt->totalAmount = $session->amount_total / 100;
        return $attempt;
    }
}
