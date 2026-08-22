<?php

namespace Modules\Inventory\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'stock' => new StockResource($this->stock),
            'supplier' => new SupplierResource($this->supplier),
            'quantity' => $this->quantity,
            'unit_cost' => $this->unit_cost,
            'ordered_at' => $this->ordered_at,
            'received_at' => $this->received_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
