<?php declare(strict_types=1);

use Noesis\Support\Collection;
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
    function env(string $key)
    {
        return $_ENV[$key];
    }
}

if (!function_exists('collect')) {
    function collect($items)
    {
        return new Collection($items);
    }
}