<?php

use Core\Container;
use App\Http\Request;
use App\Services\ApiService;
use App\Http\Controllers\ChatController;

$apiKey = $_ENV['API_KEY'] ?? null;
$apiUrl = $_ENV['API_URL'] ?? null;

if (!$apiKey || !$apiUrl) {
    throw new Exception('API key or URL not set in environment variables.');
}

// Initialize the container
$container = new Container();

// Bind services
$container->bind(Request::class, function () {
    return new Request();
});

$container->bind(ApiService::class, function () use ($apiKey, $apiUrl) {
    return new ApiService($apiKey, $apiUrl);
});

$container->bind(ChatController::class, function () use ($container) {
    return new ChatController($container->resolve(ApiService::class));
});


// Return the container for use in your application
return $container;
