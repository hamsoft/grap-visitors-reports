<?php

namespace Framework;

use Framework\Errors\NotFound;

class Router
{

    private array $routes = [];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function addRoute(string $method, string $url, array|callable $action): void
    {
        $method = strtoupper($method);

        $this->routes[] = compact('method', 'url', 'action');
    }


    public function handleRequest(Request $request)
    {
        $route = $this->findRoute($request);

        if (empty($route)) {
            throw new NotFound();
        }

        $action = $route['action'];

        if (is_array($action)) {
            $controller = $this->container->make($action[0]);
            
            if (isset($action[1])) {
                $controllerAction = $action[1];
                return $controller->{$controllerAction}($request);
            }

            $action = $controller;
        }

        return $action($request);
    }

    public function findRoute(Request $request): ?array
    {
        $requestMethod = $request->getMethod();

        $requestUri = $request->getUri();
        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['url'] === $requestUri) {
                return $route;
            }
        }

        return null;
    }

}