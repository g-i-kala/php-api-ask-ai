<?php

namespace Core;

use Exception;

class Container
{
    protected $bindings = [];

    public function bind($name, $resolver)
    {
        $this->bindings[$name] = $resolver;
    }

    public function resolve($name)
    {
        if (isset($this->bindings[$name])) {
            return call_user_func($this->bindings[$name]);
        }

        if (class_exists($name)) {
            $reflectionClass = new \ReflectionClass($name);
            $constructor = $reflectionClass->getConstructor();

            if ($constructor) {
                $parameters = $constructor->getParameters();
                $dependencies = array_map(function ($parameter) {
                    $class = $parameter->getClass();
                    if ($class) {
                        return $this->resolve($class->name);
                    }

                    if ($parameter->isDefaultValueAvailable()) {
                        return $parameter->getDefaultValue();
                    }

                    throw new Exception("Cannot resolve class dependency '{$parameter->name}'");
                }, $parameters);

                return $reflectionClass->newInstanceArgs($dependencies);
            }
            return new $name();
        }

        $availableServices = implode(', ', array_keys($this->bindings));
        throw new Exception("Service not found: {$name}. Available services: {$availableServices}");
    }
}
