<?php

namespace Modules\Order\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.stock_id' => 'required|exists:stocks,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }
}
