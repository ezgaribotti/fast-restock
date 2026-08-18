<?php

namespace Modules\Auth\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncPermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'operator_id' => 'required|exists:operators,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
}
