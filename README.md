# RITS Framework (React / Inertiajs / Tailwind / Slim)

InteriaJS with React (v18) with a Slim Framework (v4) backend and normal PHP views based on Slim/PHP-View

## Origins

Started as a fork of the amazing work of cherifGsoul/slim-inertiajs-demo, which uses Symfony Encore and Svelte. This project however does not use Encore and replaces Svelte with React.

Since then however, I have completely rewritten it and organised it into server (php) and client (js) folders.

In server, the structure resembles Laravel, and I plan to enable many of the core feature of Laravel

The aim of this project will be to allow developers to have everything for a full featured MVC at their finger tips, but only enable the parts you actually need.

## Installation

Clone

```bash
git clone https://github.com/lukewatts/slimphp-inertiajs-react.git
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

RIST has console commands (like most other frameworks)

### php rist list

List all available command

### php rist help

Show help documentation for RIST console

### php rist create:presenter --name {presenter_name}

Generates a boilerplate Presenter class in server/app/Http/Presenter

Example:

`php rist create:presenter --name Test` will generate TestPresenter in server/app/Http/Presenter which have the following boilerplate code:

```php
<?php

declare(strict_types=1);

namespace App\Http\Presenter;

use Cherif\InertiaPsr15\Middleware\InertiaMiddleware;
use Psr\Http\Message\ResponseInterface;

/**
 * Test Presenter
 */
class TestPresenter extends \Rist\Presenter\Presenter
{
	public function index($request, $response): ResponseInterface
	{
		$inertia = $request->getAttribute(InertiaMiddleware::INERTIA_ATTRIBUTE);

		return $inertia->render('Index', ['var' => 'I can be used in JSX!']);
	}
}
```