<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Modules\Common\src\Entities\Operator;
use Modules\Shipments\src\Entities\Shipment;
use Modules\Shipments\src\Entities\TrackingStatus;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

test('should return list of shipments', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $response = $this->getJson(route('shipments.index'));
    $response->assertOk();
});

test('should return a shipment', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $shipment = Shipment::factory()->create();
    $response = $this->getJson(route('shipments.show', ['shipment' => $shipment]));
    $response->assertOk();
});

test('should update a shipment', function () {
    Sanctum::actingAs(Operator::factory()->create());

    $shipment = Shipment::factory()->create();
    $trackingStatus = TrackingStatus::factory()->create();

    $response = $this->putJson(route('shipments.update', ['shipment' => $shipment]), [
        'tracking_status_id' => $trackingStatus->id
    ]);
    $response->assertOk();
});
