<?php

namespace Tests;

use Framework\App;


abstract class TestCase extends \PHPUnit\Framework\TestCase
{

    protected App $app;

    protected function setUp(): void
    {
        $this->app = require 'Framework/boot_app.php';

        parent::setUp();
    }


}