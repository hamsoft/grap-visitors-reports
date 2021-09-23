<?php

namespace Framework\Response;

use JsonException;
use Stringable;

class JsonResponse extends Response implements Stringable
{

    public function __construct($content, $status = 200)
    {
        $this->content = $content;
        $this->status = $status;

        $this->headers[] = 'Content-Type: application/json; charset=UTF-8';
    }

    /**
     * @throws JsonException
     */
    public function __toString()
    {
        return (string)(json_encode($this->content, JSON_THROW_ON_ERROR));
    }

    protected function sendContent(): void
    {
        echo $this;
    }

}