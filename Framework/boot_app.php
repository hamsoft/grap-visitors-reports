<?php

use Framework\Container;
use Framework\Container\SimpleContainer;
use Framework\Router;

require __DIR__ . '/../vendor/autoload.php';

$container = new SimpleContainer();

$container->singleton(Router::class);
$container->singleton(Container::class, $container);

return $container->make(\Framework\App::class);