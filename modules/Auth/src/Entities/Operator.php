<?php

namespace Modules\Auth\src\Entities;

use App\Entities\Entity;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as HasActingAs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Modules\Auth\database\Factories\OperatorFactory;
use Modules\Auth\src\Enums\OperatorStatus;

class Operator extends Entity implements Authenticatable
{
    use HasFactory, HasApiTokens, HasActingAs, SoftDeletes;

    protected $fillable = [
        'full_name',
        'status',
        'internal_code',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'status' => OperatorStatus::class,
        'password' => 'hashed',
    ];

    public function permissions(): object
    {
        return $this->belongsToMany(Permission::class);
    }

    protected static function newFactory(): object
    {
        return OperatorFactory::new();
    }
}
