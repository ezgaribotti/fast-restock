<?php

namespace Modules\Auth\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\database\Factories\PermissionFactory;

class Permission extends Entity
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function newFactory(): object
    {
        return PermissionFactory::new();
    }
}
