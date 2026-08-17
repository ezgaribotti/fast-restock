<?php

namespace App\Data;

use JsonSerializable;
use ReflectionClass;

abstract class Data implements JsonSerializable
{
    public function toArray(): array
    {
        $reflection = new ReflectionClass($this);

        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $value = $property->getValue($this);

            if ($value instanceof self) {
                $properties[$property->getName()] = $value->toArray();
            } else {
                $properties[$property->getName()] = $value;
            }
        }
        return $properties;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
