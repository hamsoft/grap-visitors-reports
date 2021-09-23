<?php

namespace Statistics\VisitorsCounters;

use Statistics\VisitorsCounter;

class FakeCounter implements VisitorsCounter
{
  
    public function getNumberOfVisitors(): int
    {
        return random_int(1, 1000);
    }
}