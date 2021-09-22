<?php

namespace Tests\Framework;

use Framework\Request;
use Tests\TestCase;

class RequestTest extends TestCase
{

    public function testCreate(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        $request = Request::create();
        
        $this->assertEquals('POST', $request->getMethod());
    }
    
    
}
