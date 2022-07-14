<?php declare(strict_types=1);

use Noesis\Support\Session;
use Psr\Http\Message\ServerRequestInterface;
use SlimSession\Helper;

test('Session calls Request::getAttribute with string "session"', function () {
    $request = mock(ServerRequestInterface::class)
        ->expect(
            getAttribute: function ($attribute) {
                // We only return a Helper instance if 'session' is passed
                return ($attribute === 'session') ? new Helper : false;
            }
        );

    $session = Session::from($request);

    expect($session instanceof Helper)->toBeTrue();
});
