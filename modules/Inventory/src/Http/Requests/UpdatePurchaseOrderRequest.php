<?php

namespace Modules\Inventory\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Inventory\src\Enums\PurchaseOrderStatus;

class UpdatePurchaseOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::enum(PurchaseOrderStatus::class),
            ],
            'quantity' => 'nullable|integer|min:1',
            'unit_cost' => 'nullable|numeric',
        ];
    }
}
