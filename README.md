# Noesis Framework (Slim, InertiaJS, React, TailwindCSS)

InteriaJS, React (v18) and TailwindCSS with a Slim Framework (v4) backend and normal PHP views based on Slim/PHP-View

## Origins

Started as a fork of the amazing work of cherifGsoul/slim-inertiajs-demo, which uses Symfony Encore and Svelte. This project however does not use Encore and replaces Svelte with React.

Since then however, I have completely rewritten it and organised it into src (noesis-framework), server (php), client (js and react) folders and public (web root, css, js, images etc)

In server, the structure resembles Laravel, and I plan to enable many of the core feature of Laravel

The aim of this project will be to allow developers to have everything for a full featured MVC at their finger tips, but only enable the parts you actually need.

## Installation

Clone

```bash
git clone https://github.com/lukewatts/noesis-framework.git
```

Install Composer packages

```bash
composer install
```

Install NPM packages:

```bash
yarn install
```

## Frontend Development

```bash
yarn watch
# or yarn dev
```

## Build JS for production

```bash
yarn build
```

## Run PHP server

```bash
php -S localhost:80 -t public
```

## Console

Noesis has console commands (like most other frameworks)

### php noesis list

List all available command

### php noesis help

Show help documentation for Noesis console

### php noesis pest

Run all Pest tests

### php noesis pest:init

Initialize all pest files. Run this to setup tests folder in a new project

### php noesis pest:cover

Run all Pest tests with code coverage. Requires XDEBUG with env variable XDEBUG_MODE=coverage

__NOTE:__ Windows users should use Powershell or CMD to run this command. Git Bash will not output correctly on windows for some reason (something to do with the php passtrhru() function perhaps). If you are using Git Bash, you can still use `/vendor/bin/pest --coverage` without any issues.

### php noesis create:presenter --name {presenter_name}

Generates a boilerplate Presenter class in `server/app/Presenter`

Example:

`php noesis create:presenter --name Test` will generate TestPresenter in `server/app/Presenter` which have the following boilerplate code:

```php
<?php

declare(strict_types=1);

namespace App\Presenter;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ResponseInterface;

/**
 * Test Presenter
 */
class TestPresenter extends \Noesis\Presenter\Presenter
{
    public function index($request, $response): ResponseInterface
    {
        $inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

        return $inertia->render('Index', ['var' => 'I can be used in JSX!']);
    }
}
```

### php create:provider --name {provider_name}

Generates a boilerplate Provider class in `server/app/Providers`

### php create:react-page --name {page_name}

Generates boilerplate React page in client/js/Pages

### php create:react-component --name {component_name}

Generates boilerplate React component in client/js/Components
