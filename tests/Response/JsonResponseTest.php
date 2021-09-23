<?php

namespace Tests\Response;

use Framework\Response\JsonResponse;
use PHPUnit\Framework\TestCase;

class JsonResponseTest extends TestCase
{

    public function testSendContent(): void
    {
        $testData = ['message' => 'test'];
        
        $response = new JsonResponse($testData);
        
        $response->send();

        $this->assertJsonStringEqualsJsonString(
            '{"message": "test"}', 
            $this->getActualOutputForAssertion());
    }


}
