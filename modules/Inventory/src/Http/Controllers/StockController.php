<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Inventory\src\Http\Requests\StoreStockRequest;
use Modules\Inventory\src\Http\Requests\UpdateStockRequest;
use Modules\Inventory\src\Http\Resources\StockResource;
use Modules\Inventory\src\Interfaces\StockRepositoryInterface;

class StockController extends Controller
{
    public function __construct(
        protected StockRepositoryInterface $stockRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return StockResource::collection(
            $this->stockRepository->paginate($request->all()));
    }

    public function store(StoreStockRequest $request)
    {
        return new StockResource(
            $this->stockRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new StockResource($this->stockRepository->findOrFail($id));
    }

    public function update(UpdateStockRequest $request, string $id)
    {
        $this->stockRepository->updateById($id, $request->validated());

        return new MessageResource('Stock successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->stockRepository->deleteById($id);

        return new MessageResource('Stock successfully deleted.');
    }
}
