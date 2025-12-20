<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Modules\Common\src\Enums\PaymentStatus;
use Modules\Common\src\Http\Resources\UrlToPayResource;
use Modules\Common\src\Interfaces\StripeServiceInterface;
use Modules\Shipments\src\Http\Requests\StoreShipmentRequest;
use Modules\Shipments\src\Http\Requests\UpdateShipmentRequest;
use Modules\Shipments\src\Http\Resources\ShipmentResource;
use Modules\Shipments\src\Http\Resources\ShipmentSummaryResource;
use Modules\Shipments\src\Interfaces\CountryRepositoryInterface;
use Modules\Shipments\src\Interfaces\LogisticsPointRepositoryInterface;
use Modules\Shipments\src\Interfaces\OrderRepositoryInterface;
use Modules\Shipments\src\Interfaces\PaymentRepositoryInterface;
use Modules\Shipments\src\Interfaces\ShipmentRepositoryInterface;
use Modules\Shipments\src\Interfaces\TaxRepositoryInterface;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;
use Modules\Shipments\src\Mail\ShipmentSynced;

class ShipmentController extends Controller
{
    public function __construct(
        protected ShipmentRepositoryInterface $shipmentRepository,
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected OrderRepositoryInterface $orderRepository,
        protected TaxRepositoryInterface $taxRepository,
        protected LogisticsPointRepositoryInterface $logisticsPointRepository,
        protected CountryRepositoryInterface $countryRepository,
        protected StripeServiceInterface $stripeService,
    )
    {
    }

    public function index(Request $request): object
    {
        $shipments = $this->shipmentRepository->paginate($request->filters);
        return response()->withPaginate(ShipmentSummaryResource::collection($shipments));
    }

    public function store(StoreShipmentRequest $request): object
    {
        $shipment = $this->shipmentRepository->findByOrderId($request->order_id);
        if ($shipment && $payment = $shipment->order->payment) {
            if ($payment->status === PaymentStatus::InProgress) {
                return response()->success(new UrlToPayResource($payment->url));
            }
            // To create another shipment you have to step on the existing one

            abort(422, 'The shipment has no payment in progress.');
        }
        $order = $this->orderRepository->find($request->order_id);
        $payment = $order->payment;
        if ($payment->status !== PaymentStatus::InProgress) {

            abort(422, 'The order has no payment in progress.');
        }
        // Calculate the final cost

        $weight = $order->products->sum('weight');

        abort_if($weight <= 0, 422, 'The weight of the items must be greater than 0.');

        $logisticsPoints = $request->logistics_points;
        $origin = $this->logisticsPointRepository->find($logisticsPoints[0]);

        if ($origin->country_id !== $order->country_id) {
            abort(422, 'The logistics point of origin must be the same country as the order.');
        }

        $destination = $this->logisticsPointRepository->find($logisticsPoints[1]);
        $finalCost = $this->calculateFinalCost($weight, $origin, $destination);

        // Update payment to add the shipping option

        $session = $this->stripeService->updateSession($payment->session_id, $finalCost);

        $trackingStatus = $this->trackingStatusRepository->findByName('unpaid');
        $shipment = $this->shipmentRepository->create(array_merge($request->validated(), [
            'tracking_status_id' => $trackingStatus->id,
            'final_cost' => $finalCost,
            'weight' => $weight,
            'coordinates' => json_encode([$origin->latitude, $origin->longitude,
                $destination->latitude, $destination->longitude]),
        ]));

        foreach ($logisticsPoints as $index => $logisticsPointId) {
            $shipment->logisticsPoints()
                ->attach($logisticsPointId, ['sequence' => $index + 1]);
        }

        // This amount is paid by the customer

        $this->paymentRepository->update($payment->id, [
            'total_amount' => $payment->total_amount + $finalCost]);

        return response()->success(new UrlToPayResource($session->url));
    }

    public function show(string $id): object
    {
        $shipment = $this->shipmentRepository->find($id);
        if (!$shipment) {
            abort(404, 'Shipment not found.');
        }
        return response()->success(new ShipmentResource($shipment));
    }

    public function update(UpdateShipmentRequest $request, string $id): object
    {
        $this->shipmentRepository->update($id, $request->validated());
        $shipment = $this->shipmentRepository->find($id);

        $customer = $shipment->order->customerAddress->customer;
        Mail::to($customer->email)
            ->send(new ShipmentSynced($shipment));

        return response()->justMessage('Shipment successfully updated.');
    }

    private function calculateFinalCost(float $weight, object $origin, object $destination): float
    {
        $country = $this->countryRepository->findOrFail($origin->country_id);
        list($costPerWeight, $fuelPrice) = [$country->cost_per_weight, $country->fuel_price];

        $distance = 100;

        $cost = ($weight * $costPerWeight) + ($distance * $fuelPrice); // Base cost

        // Add to the final cost all taxes

        $finalCost = $cost * (($this->taxRepository->sumTaxRateByCountryId($origin->country_id)
                    + $this->taxRepository->sumTaxRateByCountryId($destination->country_id)) / 100);

        $extraHandlingFee = $origin->service_fee + $destination->service_fee; // Sum extra fees
        return round($finalCost + $extraHandlingFee, 2);
    }
}
