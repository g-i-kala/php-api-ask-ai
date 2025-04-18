<?php

function dd($variable)
{
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    die();
}


function base_path($path)
{
    return BASE_PATH . $path;
}
