<?php

use Framework\Router;
use Statistics\StatisticsController;

/** @var Router $router  */

$router->addRoute('GET', '/api/statistics', [StatisticsController::class, 'getNumberOfVisitors']);
