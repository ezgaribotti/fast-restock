<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Interfaces\RepositoryInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Fluent;

abstract class Repository implements RepositoryInterface
{
    public function __construct(protected Entity $entity)
    {
    }

    public function all(): Collection
    {
        return $this->entity->all();
    }

    public function count(): int
    {
        return $this->entity->count();
    }

    public function paginate(?array $filters): Paginator
    {
        return $this->entity
            ->when($filters, function ($query) use ($filters) {
                foreach ($filters as $filter) {
                    $filter = new Fluent($filter);

                    if (!$filter->value) {
                        $query->whereNull($filter->by);
                        continue;
                    }
                    if (is_array($filter->value)) {

                        // For use with date ranges, among other cases

                        if (count($filter->value) != 2) {
                            abort(422, 'Range must be between two values.');
                        }

                        $query->whereBetween($filter->by, $filter->value);
                        continue;
                    }
                    $filter->strict
                        ? $query->where($filter->by, $filter->value)
                        : $query->whereLike($filter->by, str_pad($filter->value, strlen($filter->value) + 2, chr(37), STR_PAD_BOTH));
                }
            })
            ->simplePaginate(15);
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

    public function update($id, array $attributes): void
    {
        $this->entity->findOrFail($id)->update($attributes);
    }

    public function delete($id): void
    {
        $this->entity->findOrFail($id)->delete();
    }
}
