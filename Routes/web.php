<?php

$router->map('GET', '/', '\App\Http\Controllers\HomeController#index');
$router->map('GET', '/chat', '\App\Http\Controllers\ChatController#index');
$router->map('POST', '/chat', '\App\Http\Controllers\ChatController#handleChat');
