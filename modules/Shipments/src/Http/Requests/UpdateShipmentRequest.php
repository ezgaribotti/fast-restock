<?php

namespace Modules\Shipments\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tracking_status_id' => 'required|exists:tracking_statuses,id',
        ];
    }
}
