<?php declare(strict_types=1);
namespace Rist\Cli;

/**
 * Resolver Interface
 */
interface ResolverInterface
{
    /**
     * Invoke Resolver
     *
     * @return void
     */
    public function __invoke(): void;
}
