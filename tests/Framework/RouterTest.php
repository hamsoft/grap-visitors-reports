<?php

namespace Tests\Framework;

use Closure;
use Framework\Errors\NotFound;
use Framework\Request;
use Framework\Router;
use Tests\TestCase;

class RouterTest extends TestCase
{

    private Router $router;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->router = $this->app->make(Router::class);
    }

    public function testShowHomePage(): void
    {
        $this->router->addRoute('GET', '/', $this->makeAction('Home'));
        
        $response = $this->router->handleRequest($this->createRequest('GET', '/'));

        $this->assertEquals('Home', $response);
    }

    public function testNotFoundException(): void
    {
        $this->expectException(NotFound::class);

        $this->router->handleRequest($this->createRequest('POST', '/profile'));
    }

    public function testFindProfileStoringRoute(): void
    {
        $this->router->addRoute('post', '/profile', $this->makeAction('Store Profile'));

        $response = $this->router->handleRequest($this->createRequest('PoST', '/profile'));

        $this->assertEquals('Store Profile', $response);
    }

    public function testRouteWithController(): void
    {
        $this->router->addRoute('get', '/example', [ExampleController::class, 'showExamplePage']);

        $response = $this->router->handleRequest($this->createRequest('get', '/example'));

        $this->assertStringContainsString(ExampleController::class . '::showTestPage', $response);
    }

    public function testRouteWithInvokeController(): void
    {
        $this->router->addRoute('get', '/example', [ExampleController::class]);

        $response = $this->router->handleRequest($this->createRequest('get', '/example'));

        $this->assertStringContainsString(ExampleController::class . '::__invoke', $response);
    }

    private function createRequest(string $method, string $uri): Request
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        return $this->app->make(Request::class);
    }

    /**
     * @param $content
     * @return Closure
     */
    private function makeAction($content): Closure
    {
        return static function () use ($content) {
            return $content;
        };
    }
}
