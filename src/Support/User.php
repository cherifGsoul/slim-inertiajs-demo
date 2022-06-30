<?php declare(strict_types=1);
namespace Noesis\Support;

use Psr\Http\Message\ServerRequestInterface;

class User 
{
    /**
     * From request 
     *
     * @param ServerRequestInterface $request
     *
     * @return object
     */
    public static function from(ServerRequestInterface $request): object
    {
        return $request->getAttribute('User');
    }
}
