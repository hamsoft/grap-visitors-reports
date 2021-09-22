<?php

namespace Framework;

class Request
{

    private string $method;

    public function __construct($method)
    {
        $this->method = $method;
    }

    public static function create()
    {
        return new static(strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri()
    {
        return explode('?', $_SERVER['REQUEST_URI'], 2)[0];
    }

}