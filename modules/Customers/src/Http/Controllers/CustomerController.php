<?php

namespace Modules\Customers\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Customers\src\Http\Requests\StoreCustomerRequest;
use Modules\Customers\src\Http\Requests\UpdateCustomerRequest;
use Modules\Customers\src\Http\Resources\CustomerResource;
use Modules\Customers\src\Http\Resources\CustomerSummaryResource;
use Modules\Customers\src\Interfaces\CustomerRepositoryInterface;

class CustomerController extends Controller
{
    public function __construct(
        protected CustomerRepositoryInterface $customerRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $customers = $this->customerRepository->paginate($request->filters);
        return response()->withPaginate(CustomerSummaryResource::collection($customers));
    }

    public function store(StoreCustomerRequest $request): object
    {
        $this->customerRepository->create($request->validated());
        return response()->justMessage('Customer successfully created.');
    }

    public function show(string $id): object
    {
        $customer = $this->customerRepository->find($id);
        if (!$customer) {
            abort(404, 'Customer not found.');
        }
        return response()->success(new CustomerResource($customer));
    }

    public function update(UpdateCustomerRequest $request, string $id): object
    {
        $customer = $this->customerRepository->findOrFail($id);

        if ($customer->email != $request->email) {
            if ($this->customerRepository->findByEmail($request->email)) {
                abort(422, 'Email already exists.');
            }
        }

        $this->customerRepository->update($id, $request->validated());
        return response()->justMessage('Customer successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->customerRepository->delete($id);
        return response()->justMessage('Customer successfully deleted.');
    }
}
