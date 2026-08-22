<?php

namespace Modules\Inventory\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\src\Entities\Scopes\IsActiveScope;
use Modules\Inventory\database\Factories\ProductFactory;

class Product extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'is_active',
        'unit_price',
        'category_id',
        'supplier_id',
        'weight',
        'height',
        'width',
        'length',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function stockRule(): HasOne
    {
        return $this->hasOne(StockRule::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new IsActiveScope());
    }

    protected static function newFactory(): object
    {
        return ProductFactory::new();
    }
}
