<?php

namespace Modules\Inventory\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'alert_threshold' => 'required|integer|min:1',
            'capacity_limit' => 'required|integer',
            'optimum_quantity' => 'required|integer',
        ];
    }
}
