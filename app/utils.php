<?php

use Illuminate\Support\Fluent;

if (! function_exists('to_object')) {

    // To handle an array as an object

    function to_object(array $attributes = []): Fluent {
        return new Fluent($attributes);
    }
}
