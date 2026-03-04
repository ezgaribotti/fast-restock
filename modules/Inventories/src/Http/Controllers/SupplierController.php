<?php

namespace Modules\Inventories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Inventories\src\Http\Resources\SupplierSummaryResource;
use Modules\Inventories\src\Interfaces\SupplierRepositoryInterface;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository,
    )
    {
    }

    public function index(): object
    {
        $suppliers = $this->supplierRepository->all();
        return response()->success(SupplierSummaryResource::collection($suppliers));
    }
}
