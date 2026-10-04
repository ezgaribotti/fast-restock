<?php

namespace Modules\Customer\src\Http\Resources;

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
            'phone_number' => $this->phone_number,
            'addresses' => CustomerAddressResource::collection($this->addresses),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
