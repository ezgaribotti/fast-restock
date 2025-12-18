<?php

namespace Modules\Inventories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'sku' => 'required|unique:products,sku',
            'stock' => 'required|integer',
            'unit_price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'nullable',
        ];
    }
}
