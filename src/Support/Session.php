<?php declare(strict_types=1);
namespace Noesis\Support;

use Psr\Http\Message\ServerRequestInterface;
use SlimSession\Helper;

class Session
{
    public static function from(ServerRequestInterface $request): Helper
    {
        
        return $request->getAttribute('session');
    }
}
