<?php

namespace Modules\Common\src\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UrlToPayResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'url_to_pay' => $this->resource,
        ];
    }
}
