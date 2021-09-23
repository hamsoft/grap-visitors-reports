<?php

namespace Tests\Framework;


use Framework\App;
use Framework\Container;
use Framework\Errors\NotFound;
use Framework\Router;
use Tests\TestCase;

class AppTest extends TestCase
{

    /**
     * @test
     */
    public function handleExceptionsTest(): void
    {
        $router = $this->createMock(Router::class);
        $router->method('handleRequest')->willThrowException(new NotFound());
        
        $app = $this->app->make(App::class, ['router' => $router]);
        
        $response = $app->handleRequest();

        $this->assertEquals(404, $response->getStatus());
        $this->assertJsonStringEqualsJsonString('{"error":true,"message":"Not found","data":[]}', $response);
    }



}