<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Modules\Auth\src\Http\Requests\StoreOperatorRequest;
use Modules\Auth\src\Http\Requests\SyncPermissionsRequest;
use Modules\Auth\src\Http\Requests\UpdateOperatorRequest;
use Modules\Auth\src\Http\Resources\OperatorResource;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;

class OperatorController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
    )
    {
    }

    public function index(Request $request)
    {
        return OperatorResource::collection(
            $this->operatorRepository->paginate($request->all()));
    }

    public function store(StoreOperatorRequest $request)
    {
        return new OperatorResource(
            $this->operatorRepository->create($request->validated()));
    }

    public function show(string $id)
    {
        return new OperatorResource(
            $this->operatorRepository->findOrFail($id));
    }

    public function update(UpdateOperatorRequest $request, string $id)
    {
        $this->operatorRepository->updateById($id, $request->validated());

        return new MessageResource('Operator successfully updated.');
    }

    public function destroy(string $id)
    {
        $this->operatorRepository->deleteById($id);

        return new MessageResource('Operator successfully deleted.');
    }

    public function syncPermissions(SyncPermissionsRequest $request)
    {
        $operator = $this->operatorRepository->find($request->operator_id);
        $operator->permissions()->sync($request->permissions);
        $operator->tokens()->delete();

        return new MessageResource('Permissions successfully synchronized.');
    }
}
