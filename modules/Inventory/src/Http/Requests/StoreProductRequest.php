<?php

namespace Modules\Inventory\src\Http\Requests;

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
            'unit_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'weight' => 'required|integer',
            'height' => 'required|integer',
            'width' => 'required|integer',
            'length' => 'required|integer',
            'description' => 'nullable',
        ];
    }
}
