<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Inventory\src\Http\Requests\StoreProductRequest;
use Modules\Inventory\src\Http\Requests\UpdateProductRequest;
use Modules\Inventory\src\Http\Resources\ProductResource;
use Modules\Inventory\src\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return ProductResource::collection(
            $this->productRepository->paginate($request->all()));
    }

    public function store(StoreProductRequest $request)
    {
        return new ProductResource(
            $this->productRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new ProductResource($this->productRepository->findOrFail($id));
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $this->productRepository->updateById($id, $request->validated());

        return new MessageResource('Product successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->productRepository->deleteById($id);

        return new MessageResource('Product successfully deleted.');
    }
}
