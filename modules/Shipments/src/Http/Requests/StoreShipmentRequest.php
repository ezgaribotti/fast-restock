<?php

namespace Modules\Shipments\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => 'required|exists:orders,id',
            'insurance_policy_id' => 'required|exists:insurance_policies,id',
            'logistics_points' => 'required|array|size:2',
            'logistics_points.*' => 'exists:logistics_points,id',
        ];
    }
}
