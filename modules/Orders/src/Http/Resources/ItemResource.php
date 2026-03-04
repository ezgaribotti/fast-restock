<?php

namespace Modules\Orders\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product' => new ProductResource($this),
            'fixed_price' => $this->pivot->fixed_price,
            'quantity' => $this->pivot->quantity,
        ];
    }
}
