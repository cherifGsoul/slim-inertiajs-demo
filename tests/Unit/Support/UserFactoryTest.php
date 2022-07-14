<?php declare(strict_types=1);

use Noesis\Support\UserFactory;

test('UserFactory creates user correctly when passed LinkedInResourceOwner', function () {
    $resourceOwner = mock(\League\OAuth2\Client\Provider\LinkedInResourceOwner::class)
        ->expect(
            getId: fn () => 1,
            getEmail: fn () => 'my@email.test',
            getFirstName: fn () => 'User',
            getLastName: fn () => 'Name'
        );

    $user = UserFactory::fromOauthResourceOwner($resourceOwner, 'linkedin');

    expect($user['id'] === 1)->toBeTrue();
    expect($user['email'] === 'my@email.test')->toBeTrue();
    expect($user['first_name'] === 'User')->toBeTrue();
    expect($user['last_name'] === 'Name')->toBeTrue();
    expect($user['username'] === 'User Name')->toBeTrue();
    expect($user['full_name'] === 'User Name')->toBeTrue();
});

test('UserFactory creates user correctly when passed GithubResourceOwner', function () {
    $resourceOwner = mock(\League\OAuth2\Client\Provider\GithubResourceOwner::class)
        ->expect(
            getId: fn () => 1,
            getNickName: fn () => 'username',
            getEmail: fn () => 'my@email.test',
            getName: fn () => 'User Name'
        );

    $user = UserFactory::fromOauthResourceOwner($resourceOwner, 'github');

    expect($user['id'] === 1)->toBeTrue();
    expect($user['email'] === 'my@email.test')->toBeTrue();
    expect($user['first_name'] === 'User')->toBeTrue();
    expect($user['last_name'] === 'Name')->toBeTrue();
    expect($user['username'] === 'username')->toBeTrue();
    expect($user['full_name'] === 'User Name')->toBeTrue();
});

test('UserFactory creates user correctly when passed TwitterResourceOwner', function () {
    $resourceOwner = mock(\Noesis\OAuth2\Client\Provider\TwitterResourceOwner::class)
        ->expect(
            getId: fn () => 1,
            getUsername: fn () => 'username',
            getEmail: fn () => 'my@email.test',
            getName: fn () => 'User Name'
        );

    $user = UserFactory::fromOauthResourceOwner($resourceOwner, 'twitter');

    expect($user['id'] === 1)->toBeTrue();
    expect($user['email'] === 'my@email.test')->toBeTrue();
    expect($user['first_name'] === 'User')->toBeTrue();
    expect($user['last_name'] === 'Name')->toBeTrue();
    expect($user['username'] === 'username')->toBeTrue();
    expect($user['full_name'] === 'User Name')->toBeTrue();
});
