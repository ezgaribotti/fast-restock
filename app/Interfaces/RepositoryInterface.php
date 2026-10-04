<?php

namespace App\Interfaces;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

interface RepositoryInterface
{
    public function all(): Collection;

    public function paginate(array $filters = []): Paginator;

    public function find($id): ?Entity;

    public function findOrFail($id): Entity;

    public function refresh(Entity $entity): Entity;

    public function create(array $attributes): Entity;

    public function insertMany(array $values): void;

    public function update(Entity $entity, array $attributes = []): void;

    public function updateById($id, array $attributes): void;

    public function deleteById($id): void;
}
