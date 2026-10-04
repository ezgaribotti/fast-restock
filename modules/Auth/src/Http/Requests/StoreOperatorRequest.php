<?php

namespace Modules\Auth\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperatorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required',
            'internal_code' => 'required|unique:operators,internal_code',
            'email' => 'required|email|unique:operators,email',
            'password' => 'required|confirmed',
        ];
    }
}
