<?php declare(strict_types=1);
namespace App\Http\Presenter;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ResponseInterface;
use Rist\Presenter\Presenter;

class PagesPresenter extends Presenter
{
     public function home($request): ResponseInterface
     {
          $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
          return $inertia->render('Home', [
               'message' => 'Hello from Inertia Response!'
          ]);
     }

     public function contact($request): ResponseInterface
     {
          $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
          return $inertia->render('Contact', ['author' => 'Luke Watts']);
     }
}
