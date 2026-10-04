<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Modules\Inventory\src\Http\Requests\StoreCategoryRequest;
use Modules\Inventory\src\Http\Resources\CategoryResource;
use Modules\Inventory\src\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
    )
    {
    }

    public function index()
    {
        return CategoryResource::collection($this->categoryRepository->all());
    }

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(
            $this->categoryRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new CategoryResource($this->categoryRepository->findOrFail($id));
    }

    public function destroy(string $id)
    {
        $this->categoryRepository->deleteById($id);

        return new MessageResource('Category successfully deleted.');
    }
}
