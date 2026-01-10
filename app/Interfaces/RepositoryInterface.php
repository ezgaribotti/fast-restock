<?php

namespace App\Interfaces;

use App\Entities\Entity;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

interface RepositoryInterface
{
    public function all(): Collection;

    public function count(): int;

    public function paginate(?array $filters): Paginator;

    public function find($id): ?Entity;

    public function findOrFail($id): Entity;

    public function create(array $attributes): Entity;

    public function update($id, array $attributes): void;

    public function delete($id): void;
}
