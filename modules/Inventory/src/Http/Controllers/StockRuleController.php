<?php

namespace Modules\Inventory\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Inventory\src\Http\Requests\StoreStockRuleRequest;
use Modules\Inventory\src\Http\Requests\UpdateStockRuleRequest;
use Modules\Inventory\src\Http\Resources\StockRuleResource;
use Modules\Inventory\src\Interfaces\StockRuleRepositoryInterface;

class StockRuleController extends Controller
{
    public function __construct(
        protected StockRuleRepositoryInterface $ruleRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return StockRuleResource::collection(
            $this->ruleRepository->paginate($request->all()));
    }

    public function store(StoreStockRuleRequest $request)
    {
        return new StockRuleResource(
            $this->ruleRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new StockRuleResource($this->ruleRepository->findOrFail($id));
    }

    public function update(UpdateStockRuleRequest $request, string $id)
    {
        $this->ruleRepository->updateById($id, $request->validated());

        return new MessageResource('Rule successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->ruleRepository->deleteById($id);

        return new MessageResource('Rule successfully deleted.');
    }
}
