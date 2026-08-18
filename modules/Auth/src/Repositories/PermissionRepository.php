<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\Permission;
use Modules\Auth\src\Interfaces\PermissionRepositoryInterface;

class PermissionRepository extends Repository implements PermissionRepositoryInterface
{
    public function __construct(Permission $entity)
    {
        parent::__construct($entity);
    }
}
