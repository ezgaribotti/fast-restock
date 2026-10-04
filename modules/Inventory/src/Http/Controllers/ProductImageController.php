<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Modules\Inventory\src\Http\Requests\StoreProductImageRequest;
use Modules\Inventory\src\Http\Resources\ProductImageResource;
use Modules\Inventory\src\Interfaces\ProductImageRepositoryInterface;

class ProductImageController extends Controller
{
    public function __construct(
        protected ProductImageRepositoryInterface $imageRepository,
    )
    {
    }

    public function store(StoreProductImageRequest $request)
    {
        return new ProductImageResource(
            $this->imageRepository->create($request->validated()));
    }

    public function destroy(string $id)
    {
        $this->imageRepository->deleteById($id);

        return new MessageResource('Image successfully deleted.');
    }
}
