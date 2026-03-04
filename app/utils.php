<?php

use Illuminate\Support\Fluent;

if (! function_exists('config_as_object')) {

    // Get the config by key and convert it into an object

    function config_as_object(string $key): Fluent {
        return new Fluent(Config::get($key, []));
    }
}
