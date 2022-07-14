<?php declare(strict_types=1);

use Noesis\Support\User;

test('User calls Request::getAttribute with string "User"', function () {
    $request = mock(\Psr\Http\Message\ServerRequestInterface::class)
        ->expect(
            getAttribute: fn ($attribute) => (object) ['attribute' => $attribute]
        );

    $user = User::from($request);

    expect($user->attribute === 'User')->toBeTrue();
});
