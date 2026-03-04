<?php

namespace Modules\Inventories\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'active' => $this->active,
            'stock' => $this->stock,
            'alert_threshold' => $this->alert_threshold,
            'unit_price' => $this->unit_price,
            'weight' => $this->weight,
            'category' => new CategoryResource($this->category),
            'supplier' => new SupplierResource($this->supplier),
            'images' => ProductImageResource::collection($this->images),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
