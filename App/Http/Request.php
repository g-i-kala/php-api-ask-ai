<?php

namespace App\Http;

class Request
{
    private $method;
    private $postData;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $this->postData = $_POST;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getData($key, $default = null)
    {
        return $this->postData[$key] ?? $default;
    }
}
