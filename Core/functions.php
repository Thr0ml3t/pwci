<?php

use Core\Response;

function dd($var)
{
    header("HTTP/1.0 500");
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}


function isUri($route)
{
    return $_SERVER['REQUEST_URI'] === $route ? 'bg-gray-900 text-white ' : 'text-gray-300 hover:bg-gray-700 hover:text-white ';
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }
}


function base_path($path): string
{
    return BASE_PATH . $path;
}

function view($path,$attributes = [])
{
    extract($attributes);
    require base_path('views/') . $path;
}