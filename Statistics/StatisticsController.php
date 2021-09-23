<?php

namespace Statistics;

use Framework\Response\JsonResponse;

class StatisticsController
{

    public function getNumberOfVisitors(): JsonResponse
    {
        return new JsonResponse([
            'error' => false,
            'message' => '',
            'data' => [],
        ]);
    }

}