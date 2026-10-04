<?php

namespace Modules\Inventory\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alert_threshold' => 'required|integer|min:1',
            'capacity_limit' => 'required|integer',
            'optimum_quantity' => 'required|integer',
        ];
    }
}
