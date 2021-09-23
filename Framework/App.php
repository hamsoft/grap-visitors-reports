<?php

namespace Framework;

use Framework\Response\Response;

class App
{

    private Router $router;
    private Container $container;

    public function __construct(Router $router, Container $container)
    {
        $this->router = $router;
        $this->container = $container;
        $this->loadRoutes();
    }

    public function handle(Request $request): Response
    {
        try {
            $response = $this->router->handleRequest($request);
        } catch (\Throwable $e) {
            /** @var ExceptionsHandler $handler */
            $handler = $this->container->make(ExceptionsHandler::class);

            $response = $handler->render($e);
        }

        return $response;
    }

    public function make($abstract, $params = []): mixed
    {
        return $this->container->make($abstract, $params);
    }
    
    public function getContainer()
    {
        return $this->container;
    }
    

    public function handleRequest(): Response
    {
        return $this->handle($this->make(Request::class));
    }

    private function loadRoutes()
    {
        $routesDir = __DIR__ . '/../routes/';
        $files = scandir($routesDir);

        foreach ($files as $file) {
            if (is_dir($file)) {
                continue;
            }

            (static function (Router $router) use ($routesDir, $file) {
                /* $router parameter uses in routes files */
                require $routesDir.$file;
            })($this->router);
        }
    }

}