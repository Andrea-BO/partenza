<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class Pagina3ActionFactory
{
    public function __invoke(ContainerInterface $container) : Pagina3Action
    {
        return new Pagina3Action($container->get(TemplateRendererInterface::class));
    }
}
