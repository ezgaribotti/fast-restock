<?php

namespace Modules\Payment\src\Services\Strategies;

use Carbon\CarbonInterface;
use Exception;
use Modules\Payment\src\Interfaces\PaymentStrategyInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeStrategy implements PaymentStrategyInterface
{
    public StripeClient $client;
    public string $currency;

    public function __construct()
    {
        $config = config('services.stripe');

        ksort($config);
        [$apiKey, $currency] = array_values($config);

        $this->currency = $currency;
        $this->client = new StripeClient($apiKey);
    }

    public function pay(array $lineItems, CarbonInterface $expiresAt, string $returnUrl): array
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

        try {
            $session = $this->client->checkout->sessions->create([
                'line_items' => $lineItems,
                'mode' => $mode,
                'success_url' => $returnUrl,
                'expires_at' => $expiresAt->getTimestamp(),
            ]);

        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage());

            throw new Exception('We are having trouble creating the payment.');
        }

        return [$session->id, $session->amount_total / 100, $session->url];
    }
}
