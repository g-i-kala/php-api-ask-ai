<?php

const BASE_PATH = __DIR__ . '/../';

require __DIR__ . '/../vendor/autoload.php';

$router = new AltoRouter();
require __DIR__ . '/../Routes/web.php';

// Match the current request
$match = $router->match();

// Check if a route was matched
if ($match) {
    require $match['target'];
} else {
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
}
