<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class Repository implements RepositoryInterface
{
    public function __construct(protected Entity $entity)
    {
    }

    public function all(): Collection
    {
        return $this->entity->all();
    }

    public function paginate(array $filters = []): Paginator
    {
        $perPage = ((object) $filters)->per_page ?? 15; // Rescue for later use

        $filterableKeys = [$this->entity->getKeyName(), ...$this->entity->getFillable(),
            $this->entity->getCreatedAtColumn(), $this->entity->getUpdatedAtColumn()];

        // Only filter by the columns that the entity has
        $filters = array_filter($filters,
            fn ($key) => in_array($key, $filterableKeys), ARRAY_FILTER_USE_KEY);

        return $this->entity->when($filters, function (Builder $query) use ($filters) {
            foreach ($filters as $key => $value) {
                is_null($value)
                    ? $query->whereNull($key) : $query->where($key, $value);
            }
        })->simplePaginate($perPage);
    }

    public function find($id): ?Entity
    {
        return $this->entity->find($id);
    }

    public function findOrFail($id): Entity
    {
        return $this->entity->findOrFail($id);
    }

    public function create(array $attributes): Entity
    {
        return $this->entity->create($attributes);
    }

    public function insertMany(array $values): void
    {
        $this->entity->insert($values);
    }

    public function update(Entity $entity, array $attributes = []): void
    {
        $entity->fill($attributes)->saveOrFail();
    }

    public function updateById($id, array $attributes): void
    {
        $this->entity->findOrFail($id)->updateOrFail($attributes);
    }

    public function deleteById($id): void
    {
        $this->entity->findOrFail($id)->deleteOrFail();
    }
}
