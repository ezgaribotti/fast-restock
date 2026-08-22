<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\database\Factories\CategoryFactory;

class Category extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected static function newFactory(): object
    {
        return CategoryFactory::new();
    }
}
