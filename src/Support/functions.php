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