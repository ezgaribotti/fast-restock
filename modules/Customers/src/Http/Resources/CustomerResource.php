<?php

namespace Modules\Customers\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'status' => $this->status,
            'email' => $this->email,
            'full_phone' => $this->full_phone,
            'addresses' => CustomerAddressResource::collection($this->addresses),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
