<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\TaxResource;
use Modules\Shipments\src\Interfaces\TaxRepositoryInterface;

class TaxController extends Controller
{
    public function __construct(
        protected TaxRepositoryInterface $taxRepository,
    )
    {
    }

    public function index(): object
    {
        $taxes = $this->taxRepository->all();
        return response()->success(TaxResource::collection($taxes));
    }
}
