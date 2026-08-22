<?php

namespace Modules\Inventory\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'hosted_url' => 'required|url',
            'description' => 'nullable',
        ];
    }
}
