<?php

namespace Modules\Auth\src\Entities;

use App\Entities\NoTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Auth\database\Factories\PasswordResetCodeFactory;

class PasswordResetCode extends NoTimestamps
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code'
    ];

    protected $casts = [
        'code' => 'hashed',
    ];

    protected static function newFactory(): object
    {
        return PasswordResetCodeFactory::new();
    }
}
