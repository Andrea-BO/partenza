<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use Psr\Container\ContainerInterface;

class AnalizzaMailMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AnalizzaMailMiddleware
    {
        return new AnalizzaMailMiddleware();
    }
}
