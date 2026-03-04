<?php

namespace Modules\Auth\src\Interfaces;

use App\Interfaces\RepositoryInterface;
use Modules\Auth\src\Entities\Operator;

interface OperatorRepositoryInterface extends RepositoryInterface
{
    public function findByInternalCode(string $internalCode): ?Operator;

    public function findByEmail(string $email): ?Operator;

    public function updateByEmail(array $attributes, string $email): void;
}
