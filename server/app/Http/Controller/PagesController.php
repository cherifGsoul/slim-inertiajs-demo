<?php declare(strict_types=1);
namespace App\Http\Controller;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Container\ContainerInterface;

class PagesController
{
     protected $container;

     public function __construct(ContainerInterface $container) {
          $this->container = $container;
     }

     public function home($request) {
          $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
          return $inertia->render('Home', [
               'message' => 'Hello from Inertia Response!'
          ]);
     }

     public function contact($request) {
          $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);
          return $inertia->render('Contact', ['author' => 'Luke Watts']);
     }
}
