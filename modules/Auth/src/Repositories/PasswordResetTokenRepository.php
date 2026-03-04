<?php

namespace Modules\Auth\src\Repositories;

use App\Repositories\Repository;
use Modules\Auth\src\Entities\PasswordResetToken;
use Modules\Auth\src\Interfaces\PasswordResetTokenRepositoryInterface;

class PasswordResetTokenRepository extends Repository implements PasswordResetTokenRepositoryInterface
{
    public function __construct(PasswordResetToken $entity)
    {
        parent::__construct($entity);
    }

    public function findByEmail(string $email): ?PasswordResetToken
    {
        return $this->entity->whereEmail($email)->first();
    }

    public function deleteByEmail(string $email): void
    {
        $this->entity->whereEmail($email)->delete();
    }
}
