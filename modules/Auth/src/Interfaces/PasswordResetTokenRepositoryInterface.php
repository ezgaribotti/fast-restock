<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Auth\src\Entities\PasswordResetToken;

interface PasswordResetTokenRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?PasswordResetToken;

    public function deleteByEmail(string $email): void;
}
