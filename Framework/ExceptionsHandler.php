<?php

namespace Framework;

use Framework\Response\JsonResponse;

class ExceptionsHandler
{

    public function render(\Throwable|\Exception $e)
    {
        return new JsonResponse([
            'error' => true,
            'message' => $e->getMessage(),
            'data' => [],
        ], $e->getCode());
    }
}