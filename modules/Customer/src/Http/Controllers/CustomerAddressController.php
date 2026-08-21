<?php

namespace Modules\Customer\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Modules\Customer\src\Http\Requests\StoreCustomerAddressRequest;
use Modules\Customer\src\Http\Resources\CustomerAddressResource;
use Modules\Customer\src\Interfaces\CustomerAddressRepositoryInterface;

class CustomerAddressController extends Controller
{
    public function __construct(
        protected CustomerAddressRepositoryInterface $addressRepository,
    )
    {
    }

    public function store(StoreCustomerAddressRequest $request)
    {
        return new CustomerAddressResource(
            $this->addressRepository->create($request->validated()));
    }

    public function destroy(string $id)
    {
        $this->addressRepository->deleteById($id);

        return new MessageResource('Address successfully deleted.');
    }
}
