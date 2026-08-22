<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\database\Factories\ProductImageFactory;

class ProductImage extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'hosted_url',
        'description',
    ];

    protected static function newFactory(): object
    {
        return ProductImageFactory::new();
    }
}
