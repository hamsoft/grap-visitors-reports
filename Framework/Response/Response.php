<?php

namespace Framework\Response;

abstract class Response
{
    protected int $status = 200;
    protected array $headers = [];
    protected mixed $content;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function send(): void
    {
        $this->sendHeaders();

        $this->sendContent();
    }

    abstract protected function sendContent();

    private function sendHeaders(): void
    {
        if (defined('APP_TESTING') && APP_TESTING) {
            return;
        }

        foreach ($this->headers as $header) {
            header($header);
        }

        http_response_code($this->status);
    }

}