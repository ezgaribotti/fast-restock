<?php

namespace Modules\Inventories\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventories\database\Factories\ProductImageFactory;

class ProductImage extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'path',
        'full_url',
        'description',
    ];

    protected static function newFactory(): object
    {
        return ProductImageFactory::new();
    }
}
