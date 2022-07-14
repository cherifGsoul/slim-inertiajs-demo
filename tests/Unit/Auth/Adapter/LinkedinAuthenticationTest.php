<?php declare(strict_types=1);

use Illuminate\Database\Eloquent\Collection;
use Laminas\Authentication\Result;
use Mockery\Mock;
use Noesis\Auth\Adapter\LinkedinAuthentication;

test('LinkedinAuthentication::validate', function () {
    /** @var LinkedinAuthentication|Mock $linkedinAuthentication */
    $linkedinAuthentication = mock(LinkedinAuthentication::class)->makePartial();
    $linkedinAuthentication->shouldReceive( 'getUsersWhere')->andReturn(new Collection(['testuser']));

    $linkedinAuthentication->setEmail('testuser@site.test');
    expect($linkedinAuthentication->authenticate() instanceof Result)->toBeTrue();
    expect($linkedinAuthentication->authenticate()->isValid())->toBeTrue();
});
