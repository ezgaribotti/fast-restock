<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipments\database\Factories\TrackingStatusFactory;
use Modules\Shipments\src\Entities\Scopes\SortByPriorityScope;

class TrackingStatus extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'name',
        'priority',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new SortByPriorityScope());
    }

    protected static function newFactory(): object
    {
        return TrackingStatusFactory::new();
    }
}
