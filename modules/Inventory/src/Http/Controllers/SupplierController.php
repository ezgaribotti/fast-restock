<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Modules\Inventory\src\Http\Requests\StoreSupplierRequest;
use Modules\Inventory\src\Http\Resources\SupplierResource;
use Modules\Inventory\src\Interfaces\SupplierRepositoryInterface;

class SupplierController extends Controller
{
    public function __construct(
        protected SupplierRepositoryInterface $supplierRepository,
    )
    {
    }

    public function index()
    {
        return SupplierResource::collection($this->supplierRepository->all());
    }

        public function store(StoreSupplierRequest $request)
    {
        return new SupplierResource(
            $this->supplierRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new SupplierResource($this->supplierRepository->findOrFail($id));
    }

    public function destroy(string $id)
    {
        $this->supplierRepository->deleteById($id);

        return new MessageResource('Supplier successfully deleted.');
    }
}
