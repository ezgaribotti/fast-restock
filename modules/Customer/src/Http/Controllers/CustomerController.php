<?php

namespace Modules\Customer\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Customer\src\Http\Requests\StoreCustomerRequest;
use Modules\Customer\src\Http\Requests\UpdateCustomerRequest;
use Modules\Customer\src\Http\Resources\CustomerResource;
use Modules\Customer\src\Interfaces\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return CustomerResource::collection(
            $this->customerRepository->paginate($request->all()));
    }

    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(
            $this->customerRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new CustomerResource($this->customerRepository->findOrFail($id));
    }

    public function update(UpdateCustomerRequest $request, string $id)
    {
        $this->customerRepository->updateById($id, $request->validated());

        return new MessageResource('Customer successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->customerRepository->deleteById($id);

        return new MessageResource('Customer successfully deleted.');
    }
}
