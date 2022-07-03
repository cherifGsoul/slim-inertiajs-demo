<?php declare(strict_types=1);
namespace Noesis\App\Middleware;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use Psr\Http\Message\ResponseInterface;
use Slim\Middleware\Session;
use Slim\App;
use SlimSession\Helper;

class AppMiddlewareInvoker
{
    public function __invoke(App $app) {
        $container = $app->getContainer();
        $app->addMiddleware($container->get(InertiaMiddleware::class));
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        
        $app->add(new AclMiddleware);
        
        $app->add(function(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
        {
            $session = new Session([
                'name' => 'noesis',
                'autorefresh' => true,
                'lifetime' => '1 hour'
            ]);

            $request = $request->withAttribute('session', new Helper);

            return $session($request, $handler);
        });
        // $app->add(SessionMiddleware::fromSymmetricKeyDefaults(
        //     InMemory::plainText('mBC5v1sOKVvbdEitdSBenu59nfNfhwkedkJVNabosTw='),
        //     1200
        // ));

        $app->add(new WhoopsMiddleware([
            'enable' => ($container->get('config')->environment !== 'prod' && $container->get('config')->environment !== 'production') ? true : false,
            'editor' => 'vscode'
        ]));
        // $app->addErrorMiddleware(true, true, true);

        return $app;
    }
}

