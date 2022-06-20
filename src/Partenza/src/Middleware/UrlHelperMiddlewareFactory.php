<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class UrlHelperMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : UrlHelperMiddleware
    {
        return new UrlHelperMiddleware(
            $container->get(UrlHelper::class)
        );
    }
}
