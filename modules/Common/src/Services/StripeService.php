<?php

namespace Modules\Common\src\Services;

use Illuminate\Support\Facades\URL;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;

class StripeService implements StripeServiceInterface
{
    const COMPLETE = Session::STATUS_COMPLETE;
    const EXPIRED = Session::STATUS_EXPIRED;
    const PAYMENT_PAID = Session::PAYMENT_STATUS_PAID;

    public function createSession(int $referenceId, string $trackingCode, string $email, array $items, array $routeNames): object
    {
        $config = config_as_object('stripe');

        $lineItems = [];
        collect($items)->each(function ($item) use (&$lineItems, $config) {
            $product = $item->product;
            $lineItems[] = [
                'price_data' => [
                    'currency' => $config->currency,
                    'product_data' => [
                        'name' => $product->name,
                    ],
                    'unit_amount_decimal' => round($product->unit_price * 100),
                ],
                'quantity' => $item->quantity,
            ];
        });

        $payload = [
            'mode' => $config->mode,
            'client_reference_id' => $referenceId,
            'customer_email' => $email,
            'line_items' => $lineItems,
            'expires_at' => now()->addMinutes(140)->timestamp,
        ];
        $parameters = [
            'reference_id' => $referenceId,
            'tracking_code' => $trackingCode, // It is used to recover the payment
        ];

        foreach ($routeNames as $key => $routeName) {
            $payload[$key] = URL::signedRoute($routeName, $parameters);
        }

        try {
            $client = new StripeClient($config->secret_key);
            $session = $client->checkout->sessions->create($payload);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to create Stripe checkout session.');
        }
        return $session;
    }

    public function retrieveSession(string $id): object
    {
        $secretKey = config('stripe.secret_key');

        try {
            $client = new StripeClient($secretKey);
            $session = $client->checkout->sessions->retrieve($id);
        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to retrieve Stripe checkout session.');
        }
        return $session;
    }

    public function expireSession(string $id): void
    {
        $secretKey = config('stripe.secret_key');

        try {
            $client = new StripeClient($secretKey);
            $client->checkout->sessions->expire($id);

        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to expire Stripe checkout session.');
        }
    }

    public function updateSession(string $id, float $shippingCost): object
    {
        $config = config_as_object('stripe');

        $payload = [
            'shipping_options' => [[
                'shipping_rate_data' => array_merge($config->shipping_rate, [
                    'fixed_amount' => [
                        'currency' => $config->currency,
                        'amount' => round($shippingCost * 100)
                    ]
                ]),
            ]]
        ];

        try {
            $client = new StripeClient($config->secret_key);
            $session = $client->checkout->sessions->update($id, $payload);

        } catch (ApiErrorException $exception) {
            logger()->error($exception->getMessage(), $exception->getJsonBody());

            abort(500, 'Error trying to update Stripe checkout session.');
        }
        return $session;
    }
}
