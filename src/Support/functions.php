<?php declare(strict_types=1);

use Noesis\Support\User;
use Noesis\Support\Session;

if (!function_exists('session')) {
    function session($request)
    {
        return Session::from($request);
    }
}

if (!function_exists('user')) {
    function user($request)
    {
        return User::from($request);
    }
}

if (!function_exists('env')) {
    function env(string $key, mixed $default = null)
    {
        return (!is_array($_ENV) || !array_key_exists($key, $_ENV))
            ? $default : $_ENV[$key];
    }
}
