<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use Psr\Container\ContainerInterface;

class ConfigAppMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : ConfigAppMiddleware
    {
        $configurazione = $container->get('config')['configurazione_app'];

        return new ConfigAppMiddleware(
            $configurazione
        );
    }
}
