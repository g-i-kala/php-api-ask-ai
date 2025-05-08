<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

$router = new AltoRouter();
require BASE_PATH . 'Routes/web.php';

$container = require BASE_PATH . 'bootstrap/bootstrap.php';

// Match the current request
$match = $router->match();

// Check if a route was matched
if ($match) {
    list($controllerName, $method) = explode('#', $match['target']);

    if (class_exists($controllerName) && method_exists($controllerName, $method)) {

        $controller = $container->resolve($controllerName);
        $request = $container->resolve(\App\Http\Request::class);

        call_user_func_array([$controller, $method], array_merge([$request], $match['params']));
    } else {
        // Handle method not callable
        header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error');
        echo "Error: Method not callable";
    }

} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
