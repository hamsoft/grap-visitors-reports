<?php

namespace Statistics;

use Framework\Container;
use RuntimeException;
use Statistics\VisitorsCounters\FakeCounter;

class VisitorsCountersFactory
{
    private const DRIVERS = [
        'fake' => FakeCounter::class,
    ];
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $config
     * @return VisitorsCounter
     */
    public function make(array $config): VisitorsCounter
    {
        $driver = $config['driver'] ?? null;
        
        if(!isset(self::DRIVERS[$driver])) {
            throw new VisitorCounterException('Driver not exists', 500); 
        }
        
        $visitorClass = self::DRIVERS[$driver];
        
        return $this->container->make($visitorClass, ['config' => $config]);
    }
    
}