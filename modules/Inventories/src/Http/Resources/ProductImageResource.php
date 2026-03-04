<?php

namespace Modules\Inventories\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_url' => $this->full_url,
            'description' => $this->description
        ];
    }
}
