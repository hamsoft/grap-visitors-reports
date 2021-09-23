<?php

namespace Tests;

use Framework\App;
use Framework\Container;


abstract class TestCase extends \PHPUnit\Framework\TestCase
{

    protected App $app;
    protected Container $container;
    protected bool $withContainer = true; 

    protected function setUp(): void
    {
        $this->app = require __DIR__ . '/../Framework/boot_app.php';
        
        if($this->withContainer) {
            $this->container = $this->app->getContainer();
        }

        parent::setUp();
    }


}