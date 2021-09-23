<?php

namespace Tests\Statistics;

use Framework\Config;
use JsonException;
use Statistics\StatisticsController;
use Statistics\VisitorsCounters\FakeCounter;
use Tests\TestCase;

class StatisticsControllerTest extends TestCase
{

    /**
     * @throws JsonException
     */
    public function testGetNumberOfVisitors(): void
    {
        $this->prepareFakeCounter();
        $this->prepareConfig();

        $statisticsController = $this->app->make(StatisticsController::class);

        $response = $statisticsController->getNumberOfVisitors();

        $expectedData = json_encode([
            'test1' => 300,
            'test2' => 400
        ], JSON_THROW_ON_ERROR);

        $this->assertJsonStringEqualsJsonString(
            "{\"error\":false, \"message\":\"\", \"data\":$expectedData}", (string)$response);
    }

    private function prepareConfig(): void
    {
        $config = $this->createStub(Config::class);
        $config->method('get')->willReturn([
            'test1' => ['driver' => 'fake'],
            'test2' => ['driver' => 'fake']
        ]);
        $this->container->singleton(Config::class, $config);
    }

    private function prepareFakeCounter(): void
    {
        $fakeCounter = $this->createStub(FakeCounter::class);
        $fakeCounter->method('getNumberOfVisitors')->willReturn(300, 400);
        $this->container->singleton(FakeCounter::class, $fakeCounter);
    }
}
