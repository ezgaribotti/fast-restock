<?php

namespace Modules\Inventories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Inventories\src\Http\Requests\UploadProductImageRequest;
use Modules\Inventories\src\Interfaces\ProductImageRepositoryInterface;
use Modules\Inventories\src\Interfaces\ProductRepositoryInterface;

class ProductImageController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected ProductImageRepositoryInterface $imageRepository,
    )
    {
    }

    public function store(UploadProductImageRequest $request): object
    {
        $product = $this->productRepository->findBySku($request->sku);

        $path = $request->image_file->store('images');

        $this->imageRepository->create([
            'product_id' => $product->id,
            'path' => $path,
            'full_url' => Storage::url($path),
            'description' => $request->description ?? $product->name,
        ]);

        return response()->justMessage('Image successfully uploaded.');
    }

    public function destroy(string $id): object
    {
        $image = $this->imageRepository->findOrFail($id);
        if (Storage::exists($image->path)) {
            Storage::delete($image->path);
        }

        $this->imageRepository->delete($id);
        return response()->justMessage('Image successfully deleted.');
    }
}
