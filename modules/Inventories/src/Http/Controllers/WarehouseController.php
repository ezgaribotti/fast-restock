<?php

namespace Modules\Inventories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Inventories\src\Http\Resources\WarehouseResource;
use Modules\Inventories\src\Interfaces\WarehouseRepositoryInterface;

class WarehouseController extends Controller
{
    public function __construct(
        protected WarehouseRepositoryInterface $warehouseRepository,
    )
    {
    }

    public function index(): object
    {
        $warehouses = $this->warehouseRepository->all();
        return response()->success(WarehouseResource::collection($warehouses));
    }
}
