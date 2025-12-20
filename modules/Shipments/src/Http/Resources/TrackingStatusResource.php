<?php

namespace Modules\Shipments\src\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackingStatusResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
