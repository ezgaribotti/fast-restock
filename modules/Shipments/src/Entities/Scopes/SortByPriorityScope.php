<?php

namespace Modules\Shipments\src\Entities\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortByPriorityScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy('priority');
    }
}
