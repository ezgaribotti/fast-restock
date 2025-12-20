<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\Operator;
use Modules\Auth\src\Interfaces\OperatorRepositoryInterface;

class OperatorRepository extends Repository implements OperatorRepositoryInterface
{
    public function __construct(Operator $entity)
    {
        parent::__construct($entity);
    }

    public function findByInternalCode(string $internalCode): ?Operator
    {
        return $this->entity->whereInternalCode($internalCode)->first();
    }

    public function findByEmail(string $email): ?Operator
    {
        return $this->entity->whereEmail($email)->first();
    }

    public function updateByEmail(array $attributes, string $email): void
    {
        $this->entity->whereEmail($email)->update($attributes);
    }
}
