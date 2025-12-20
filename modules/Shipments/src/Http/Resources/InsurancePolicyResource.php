<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsurancePolicyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'coverage_rate' => $this->coverage_rate,
            'description' => $this->description,
        ];
    }
}
