<?php

namespace Statistics;

use Framework\Config;
use Framework\Response\JsonResponse;

class StatisticsController
{
    private VisitorsCountersFactory $countersFactory;
    private Config $config;

    public function __construct(VisitorsCountersFactory $countersFactory, Config $config)
    {
        $this->countersFactory = $countersFactory;
        $this->config = $config;
    }

    public function getNumberOfVisitors(): JsonResponse
    {
        $data = [];
                
        foreach ($this->config->get('sources', []) as $name => $source) {
            $counter = $this->countersFactory->make($source);
            
            $data[$name] = $counter->getNumberOfVisitors();
        }
        
        return new JsonResponse([
            'error' => false,
            'message' => '',
            'data' => $data,
        ]);
    }

}