<?php

namespace Modules\Customer\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'observations' => 'nullable',
        ];
    }
}
