<?php

namespace Framework;

class Request
{

    private string $method;
    private string $uri;

    public function __construct($method = null, $uri = null)
    {
        $uri = $uri ?? $_SERVER['REQUEST_URI'] ?? '/';
        $this->method = $method ?? strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->uri = explode('?', $uri, 2)[0];
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

}