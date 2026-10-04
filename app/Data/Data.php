<?php

namespace App\Data;

use Illuminate\Support\Str;
use JsonSerializable;
use ReflectionClass;

abstract class Data implements JsonSerializable
{
    public function __construct(array $properties = [])
    {
        foreach ($properties as $property => $value) {
            $this->{Str::camel($property)} = $value;
        }
    }

    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);

        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            if (! $property->isInitialized($this)) continue;

            $value = $property->getValue($this);
            $properties[Str::snake($property->getName())] = $value instanceof self
                ? $value->toArray() : $value;
        }
        return $properties;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
