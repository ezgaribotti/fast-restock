<?php

namespace Modules\Customer\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Customer\src\Enums\CustomerStatus;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'status' => [
                'required',
                Rule::enum(CustomerStatus::class),
            ],
            'phone_number' => 'required',
        ];
    }
}
