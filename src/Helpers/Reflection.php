<?php

namespace Spatie\Menu\Helpers;

use ReflectionFunction;
use ReflectionObject;
use ReflectionParameter;
use Spatie\Menu\Item;

class Reflection
{
    public static function firstParameterType(callable $callable): string
    {
        $reflection = is_object($callable)
            ? (new ReflectionObject($callable))->getMethod('__invoke')
            : new ReflectionFunction($callable);

        $parameters = $reflection->getParameters();

        $parameterTypes = array_map(function (ReflectionParameter $parameter) {
            return $parameter->getClass() ? $parameter->getClass()->name : null;
        }, $parameters);

        return $parameterTypes[0] ?? '';
    }

    public static function itemMatchesType(Item $item, string $type): bool
    {
        if ($type === '') {
            return true;
        }

        return $item instanceof $type;
    }
}
