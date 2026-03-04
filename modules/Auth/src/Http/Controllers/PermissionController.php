<?php

namespace Modules\Auth\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Auth\src\Http\Resources\PermissionResource;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionRepositoryInterface $permissionRepository
    )
    {
    }

    public function index(): object
    {
        $permissions = $this->permissionRepository->all();
        return response()->success(PermissionResource::collection($permissions));
    }
}
