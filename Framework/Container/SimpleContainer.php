<?php

namespace Framework\Container;

use Framework\Container;
use ReflectionClass;
use ReflectionException;

class SimpleContainer implements Container
{
    private array $singletons = [];

    /**
     * @param $abstract
     * @param null $instance
     * @return Container
     */
    public function singleton($abstract,  $instance = null): Container
    {
        if (!isset($this->singletons[$abstract])) {
            $this->singletons[$abstract] = $instance;
        }
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function make($abstract, array $params = []): mixed
    {
        $instance = $this->singletons[$abstract] ?? null;

        if ($instance) {
            return $instance;
        }

        $instance = $this->buildInstance($abstract, $params);

        if (array_key_exists($abstract, $this->singletons)) {
            $this->singletons[$abstract] = $instance;
        }

        return $instance;
    }

    /**
     * @param $abstract
     * @param array $params
     * @return object
     * @throws ReflectionException
     */
    private function buildInstance($abstract, array $params = []): object
    {
        $reflection = new ReflectionClass($abstract);

        $constructor = $reflection->getConstructor();
        if (!$constructor || $constructor->getNumberOfParameters() === 0) {
            return $reflection->newInstance();
        }

        $dependencies = [];
        foreach ($constructor->getParameters() as $parameter) {
            if ($parameter->hasType()) {
                $dependencies[] = $params[$parameter->getName()] ?? $this->make($parameter->getType()->getName());
            }
        }

        return $reflection->newInstance(...$dependencies);
    }


}