<?php

namespace Modules\Order\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'stock_id' => $this->stock_id,
            'quantity' => $this->quantity,
            'unit_sale_price' => $this->unit_sale_price,
        ];
    }
}
