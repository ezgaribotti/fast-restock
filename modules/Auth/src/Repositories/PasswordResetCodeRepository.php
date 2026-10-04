<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\PasswordResetCode;
use Modules\Auth\src\Interfaces\PasswordResetCodeRepositoryInterface;

class PasswordResetCodeRepository extends Repository implements PasswordResetCodeRepositoryInterface
{
    public function __construct(PasswordResetCode $entity)
    {
        parent::__construct($entity);
    }

    public function findByEmail(string $email): ?PasswordResetCode
    {
        return $this->entity->whereEmail($email)->first();
    }

    public function deleteByEmail(string $email): void
    {
        $this->entity->whereEmail($email)->delete();
    }
}
