<?php

namespace Modules\Auth\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\database\Factories\PermissionFactory;

class Permission extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ability',
    ];

    protected static function newFactory(): object
    {
        return PermissionFactory::new();
    }
}
