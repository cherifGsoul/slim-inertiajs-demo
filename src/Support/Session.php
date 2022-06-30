<?php declare(strict_types=1);
namespace Noesis\Support;

use PSR7Sessions\Storageless\Http\SessionMiddleware;
use PSR7Sessions\Storageless\Session\SessionInterface;
use Psr\Http\Message\ServerRequestInterface;

class Session
{
    public static function from(ServerRequestInterface $request): SessionInterface
    {
        return $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
    }
}
