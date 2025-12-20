<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventories\database\Factories\CategoryFactory;

class Category extends NoTimestamps
{
    use HasFactory;

    protected static function newFactory(): object
    {
        return CategoryFactory::new();
    }
}
