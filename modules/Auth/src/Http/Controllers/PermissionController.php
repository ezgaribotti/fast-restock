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

    public function index()
    {
        return PermissionResource::collection($this->permissionRepository->all());
    }
}
