<?php

namespace App\Http;

class Request
{
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies
    )
    {
    }

    public static function createFromGlobals(): static
    {
        return new self($_GET, $_POST, $_SERVER, $_FILES, $_COOKIE);
    }

    public function uri()
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }
}