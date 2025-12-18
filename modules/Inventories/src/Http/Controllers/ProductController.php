<?php

namespace Modules\Inventories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventories\src\Http\Requests\StoreProductRequest;
use Modules\Inventories\src\Http\Requests\UpdateProductRequest;
use Modules\Inventories\src\Http\Resources\ProductResource;
use Modules\Inventories\src\Http\Resources\ProductSummaryResource;
use Modules\Inventories\src\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $products = $this->productRepository->paginate($request->filters);
        return response()->withPaginate(ProductSummaryResource::collection($products));
    }

    public function store(StoreProductRequest $request): object
    {
        $this->productRepository->create($request->validated());
        return response()->justMessage('Product successfully created.');
    }

    public function show(string $id): object
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            abort(404, 'Product not found.');
        }
        return response()->success(new ProductResource($product));
    }

    public function update(UpdateProductRequest $request, string $id): object
    {
        $product = $this->productRepository->findOrFail($id);

        if ($product->sku != $request->sku) {
            if ($this->productRepository->findBySku($request->sku)) {
                abort(422, 'Sku already exists.');
            }
        }

        $this->productRepository->update($id, $request->validated());
        return response()->justMessage('Product successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->productRepository->delete($id);
        return response()->justMessage('Product successfully deleted.');
    }
}
