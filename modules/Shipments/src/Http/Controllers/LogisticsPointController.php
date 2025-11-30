<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\LogisticsPointResource;
use Modules\Shipments\src\Interfaces\LogisticsPointRepositoryInterface;

class LogisticsPointController extends Controller
{
    public function __construct(
        protected LogisticsPointRepositoryInterface $logisticsPointRepository,
    )
    {
    }

    public function index(): object
    {
        $logisticsPoints = $this->logisticsPointRepository->all();
        return response()->success(LogisticsPointResource::collection($logisticsPoints));
    }
}
