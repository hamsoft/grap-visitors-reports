<?php

namespace Tests;

use Statistics\StatisticsController;

class StatisticsControllerTest extends TestCase
{

    private StatisticsController $statisticsController;

    public function testGetNumberOfVisitors(): void
    {
        $this->statisticsController = $this->app->make(StatisticsController::class);

        $response = $this->statisticsController->getNumberOfVisitors();

        $this->assertJsonStringEqualsJsonString(
            '{"error":false, "message":"", "data":[]}', (string)$response);
    }
}
