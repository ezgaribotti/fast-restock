<?php

namespace Modules\Shipments\src\Entities;

use App\Entities\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Shipments\database\Factories\InsurancePolicyFactory;

class InsurancePolicy extends Entity
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'coverage_rate',
        'description',
    ];

    protected static function newFactory(): object
    {
        return InsurancePolicyFactory::new();
    }
}
