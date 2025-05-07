<?php

const BASE_PATH = __DIR__ . '/../';

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new AltoRouter();
require __DIR__ . '/../Routes/web.php';

// Match the current request
$match = $router->match();

// Check if a route was matched
if ($match) {
    list($controllerName, $method) = explode('#', $match['target']);

    if (class_exists($controllerName) && method_exists($controllerName, $method)) {
        $controller = new $controllerName();
        call_user_func_array([$controller, $method], $match['params']);
    } else {
        // Handle method not callable
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error');
        echo "Error: Method not callable";
    }

} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
