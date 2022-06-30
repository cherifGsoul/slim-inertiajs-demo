<?php declare(strict_types=1);
namespace Noesis\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;

class AppSessionMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $User = (object) [
            'id' => 1,
            'username' => 'LukeWatts85'
        ];
        session($request)->set('user', $User);

        // This will still be an object
        $request = $request->withAttribute('User', $User); 
        
        return $handler->handle($request);
    }
}