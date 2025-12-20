<?php

namespace Modules\Auth\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\database\Factories\PasswordResetTokenFactory;

class PasswordResetToken extends Entity
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'email',
        'token',
    ];

    protected static function newFactory(): object
    {
        return PasswordResetTokenFactory::new();
    }
}
