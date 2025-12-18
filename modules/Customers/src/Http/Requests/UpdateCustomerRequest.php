<?php

namespace Modules\Customers\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'status' => 'required|in:active,banned',
            'email' => 'required|email',
            'full_phone' => 'required',
        ];
    }
}
