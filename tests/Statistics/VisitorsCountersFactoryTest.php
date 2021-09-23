<?php

namespace Tests\Statistics;

use Statistics\VisitorCounterException;
use Statistics\VisitorsCounters\FakeCounter;
use Statistics\VisitorsCountersFactory;
use Tests\TestCase;

class VisitorsCountersFactoryTest extends TestCase
{

    private VisitorsCountersFactory $factory;

    public function testMakeFakeCounter(): void
    {
        $counter = $this->factory->make(['driver' => 'fake']);

        $this->assertInstanceOf(FakeCounter::class, $counter);
    }

    public function testFailDriverNotExists()
    {
        $this->expectException(VisitorCounterException::class);
        $this->factory->make([]);
        
        $this->expectException(VisitorCounterException::class);
        $this->factory->make(['driver' => 'tre']);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->app->make(VisitorsCountersFactory::class);
    }
}
