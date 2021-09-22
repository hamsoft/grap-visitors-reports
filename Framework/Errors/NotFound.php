<?php

namespace  Framework\Errors;

use RuntimeException;
use Throwable;

class NotFound extends RuntimeException
{
    
    protected $message = 'Not found';
    protected $code = 404;

}