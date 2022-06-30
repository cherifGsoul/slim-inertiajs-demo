<?php declare(strict_types=1);
namespace Noesis\App\Middleware;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Lcobucci\JWT\Signer\Key\InMemory;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use Slim\App;

class AppMiddlewareInvoker
{
    public function __invoke(App $app) {
        $container = $app->getContainer();
        $app->addMiddleware($container->get(InertiaMiddleware::class));
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();
        
        $app->add(new AclMiddleware);
        
        $app->add(new AppSessionMiddleware);
        $app->add(SessionMiddleware::fromSymmetricKeyDefaults(
            InMemory::plainText('mBC5v1sOKVvbdEitdSBenu59nfNfhwkedkJVNabosTw='),
            1200
        ));

        $app->add(new WhoopsMiddleware([
            'enable' => ($container->get('config')->environment !== 'prod' && $container->get('config')->environment !== 'production') ? true : false,
            'editor' => 'vscode'
        ]));
        // $app->addErrorMiddleware(true, true, true);

        return $app;
    }
}

