<?php

namespace Modules\Inventory\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StockRuleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'alert_threshold' => $this->alert_threshold,
            'capacity_limit' => $this->capacity_limit,
            'optimum_quantity' => $this->optimum_quantity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
