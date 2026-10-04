<?php

namespace Modules\Inventory\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'hosted_image_url' => $this->hosted_url,
            'description' => $this->description
        ];
    }
}
