<?php

namespace Modules\Shipments\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Shipments\src\Http\Resources\InsurancePolicyResource;
use Modules\Shipments\src\Interfaces\InsurancePolicyRepositoryInterface;

class InsurancePolicyController extends Controller
{
    public function __construct(
        protected InsurancePolicyRepositoryInterface $insurancePolicyRepository,
    )
    {
    }

    public function index(): object
    {
        $policies = $this->insurancePolicyRepository->all();
        return response()->success(InsurancePolicyResource::collection($policies));
    }
}
