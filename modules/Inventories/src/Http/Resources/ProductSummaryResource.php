<?php

namespace Modules\Inventories\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'active' => $this->active,
            'stock' => $this->stock,
            'unit_price' => $this->unit_price,
        ];
    }
}
