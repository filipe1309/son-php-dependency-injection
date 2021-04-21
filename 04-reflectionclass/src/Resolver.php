<?php

namespace SON\Di;

class Resolver
{
    public function resolveClass($class, $dependencies_inject = [])
    {
        if ($dependencies_inject !== []) {
            $this->dependencies_inject = $dependencies_inject;
        }

        if (is_string($class)) {
            $class = new \ReflectionClass($class);
        }

        if (!$class->isInstantiable()) {
            throw new \Exception("{$class->name} is not instantiable");
        }

        $constructor = $class->getConstructor();

        if (is_null($constructor)) {
            return new $class->name;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->getDependencies($parameters);

        return $class->newInstanceArgs($dependencies);
    }

    protected function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if (is_null($dependency)) {
                // not a class
            } else {
                $dependencies[] = $this->resolveClass($dependency);
            }
        }

        return $dependencies;
    }
}
