<?php

namespace Tests\Framework;

use Framework\Request;

class ExampleController
{
    
    public function __invoke()
    {
        return __CLASS__ . '::__invoke';
    }

    public function showExamplePage(Request $request)
    {
        return __CLASS__ . '::showTestPage ' . $request->getMethod();
    }

}