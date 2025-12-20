<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Auth\src\Enums\OperatorStatus;
use Modules\Auth\src\Http\Requests\StoreOperatorRequest;
use Modules\Auth\src\Http\Requests\SyncPermissionsRequest;
use Modules\Auth\src\Http\Requests\UpdateOperatorRequest;
use Modules\Auth\src\Http\Resources\OperatorResource;
use Modules\Auth\src\Http\Resources\OperatorSummaryResource;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;

class OperatorController extends Controller
{
    public function __construct(
        protected OperatorRepositoryInterface $operatorRepository,
    )
    {
    }

    public function index(Request $request): object
    {
        $operators = $this->operatorRepository->paginate($request->filters);
        return response()->withPaginate(OperatorSummaryResource::collection($operators));
    }

    public function store(StoreOperatorRequest $request): object
    {
        $this->operatorRepository->create($request->validated());
        return response()->justMessage('Operator successfully created.');
    }

    public function show(string $id): object
    {
        $operator = $this->operatorRepository->find($id);
        if (!$operator) {
            abort(404, 'Operator not found.');
        }
        return response()->success(new OperatorResource($operator));
    }

    public function update(UpdateOperatorRequest $request, string $id): object
    {
        $operator = $this->operatorRepository->findOrFail($id);

        if ($operator->internal_code != $request->internal_code) {
            if ($this->operatorRepository->findByInternalCode($request->internal_code)) {
                abort(422, 'Internal code already exists.');
            }
        }

        if ($operator->email != $request->email) {
            if ($this->operatorRepository->findByEmail($request->email)) {
                abort(422, 'Email already exists.');
            }
        }

        $this->operatorRepository->update($id, $request->validated());
        return response()->justMessage('Operator successfully updated.');
    }

    public function destroy(string $id): object
    {
        $this->operatorRepository->update($id, [
            'status' => OperatorStatus::Blocked]);

        $this->operatorRepository->delete($id);
        return response()->justMessage('Operator successfully deleted.');
    }

    public function syncPermissions(SyncPermissionsRequest $request): object
    {
        $operator = $this->operatorRepository->find($request->operator_id);
        $operator->permissions()->sync($request->permissions);
        $operator->tokens()->delete();
        return response()->justMessage('Permissions successfully synchronized.');
    }
}
