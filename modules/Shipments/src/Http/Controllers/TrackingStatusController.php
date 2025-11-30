<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\TrackingStatusResource;
use Modules\Shipments\src\Interfaces\TrackingStatusRepositoryInterface;

class TrackingStatusController extends Controller
{
    public function __construct(
        protected TrackingStatusRepositoryInterface $trackingStatusRepository,
    )
    {
    }

    public function index(): object
    {
        $statuses = $this->trackingStatusRepository->all();
        return response()->success(TrackingStatusResource::collection($statuses));
    }
}
