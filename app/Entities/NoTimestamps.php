<?php

namespace App\Entities;

abstract class NoTimestamps extends Entity
{
    public $timestamps = false;
}
