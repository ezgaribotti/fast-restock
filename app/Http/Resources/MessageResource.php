<?php

namespace App\Http\Resources;

use App\Data\Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    protected int $statusCode;
    public static $wrap = null;

    public function __construct(?string $message = null, int $statusCode = 200)
    {
        parent::__construct($message);

        // Ensure all errors use a standardized HTTP status code

        if (! in_array($statusCode, [200, 400, 401, 403, 404, 422, 429, 500, 503])) {

            // Any other status code is treated as 500
            $statusCode = 500;
        }
        $this->statusCode = $statusCode;
    }

    public function toArray(Request $request): array
    {
        return (new class($this->resource) extends Data {
            public function __construct(
                public ?string $message
            )
            {
            }
        })->toArray();
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {

        $response->setStatusCode($this->statusCode);
    }
}
