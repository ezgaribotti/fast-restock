<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Auth\src\Entities\PasswordResetCode;

interface PasswordResetCodeRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?PasswordResetCode;

    public function deleteByEmail(string $email): void;
}
