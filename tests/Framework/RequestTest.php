<?php

namespace Tests\Framework;

use Framework\Request;
use Tests\TestCase;

class RequestTest extends TestCase
{

    public function testCreate(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        
        $request = $this->app->make(Request::class);
        
        $this->assertEquals('POST', $request->getMethod());
    }
    
    
}
