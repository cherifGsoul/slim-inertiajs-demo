# RIST Framework (React / Inertiajs / Slim / Tailwind)

Demo of how to integrate InteriaJS with React (v18) into the Slim Framework (v4) with normal PHP views based on Slim/PHP-View

Started as a fork of the amazing work of cherifGsoul/slim-inertiajs-demo, which uses Symfony Encore and Svelte.

This project however does not use Encore and replaces Svelte with React

Since then however, I have completely rewritten it and organised it into server (php) and client (js) folders.

In server, the structure resembled Laravel, and I plan to enable many of the core feature of Laravel

The aim of this project will be to allow developers to have everything for a full featured MVC at their finger tips, but only enable the parts you actually need.

## Installation

Composer packages

```bash
composer install
```

NPM packages:

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
