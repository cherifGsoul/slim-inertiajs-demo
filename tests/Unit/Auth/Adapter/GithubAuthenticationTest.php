<?php declare(strict_types=1);

use Illuminate\Database\Eloquent\Collection;
use Laminas\Authentication\Result;
use Mockery\Mock;
use Noesis\Auth\Adapter\GithubAuthentication;

test('GithubAuthentication::validate', function () {
    /** @var GithubAuthentication|Mock $githubAuthentication */
    $githubAuthentication = mock(GithubAuthentication::class)->makePartial();
    $githubAuthentication->shouldReceive( 'getUsersWhere')->andReturn(new Collection(['testuser']));

    $githubAuthentication->setEmail('testuser@website.test');
    expect($githubAuthentication->authenticate() instanceof Result)->toBeTrue();
    expect($githubAuthentication->authenticate()->isValid())->toBeTrue();
});
