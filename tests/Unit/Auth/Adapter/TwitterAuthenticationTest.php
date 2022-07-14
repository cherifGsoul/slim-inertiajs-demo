<?php declare(strict_types=1);

use Illuminate\Database\Eloquent\Collection;
use Laminas\Authentication\Result;
use Mockery\Mock;
use Noesis\Auth\Adapter\TwitterAuthentication;

test('TwitterAuthentication::validate', function () {
    /** @var TwitterAuthentication|Mock $twitterAuth */
    $twitterAuth = mock(TwitterAuthentication::class)->makePartial();
    $twitterAuth->shouldReceive( 'getUsersWhere')->andReturn(new Collection(['testuser']));

    $twitterAuth->setUsername('testuser');
    expect($twitterAuth->authenticate() instanceof Result)->toBeTrue();
    expect($twitterAuth->authenticate()->isValid())->toBeTrue();
});
