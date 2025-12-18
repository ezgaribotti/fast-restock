<?php

namespace Modules\Auth\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OperatorSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'status' => $this->status,
            'internal_code' => $this->internal_code,
            'email' => $this->email,
        ];
    }
}
