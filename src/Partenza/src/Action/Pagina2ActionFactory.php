<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class Pagina2ActionFactory
{
    public function __invoke(ContainerInterface $container) : Pagina2Action
    {
        return new Pagina2Action($container->get(TemplateRendererInterface::class));
    }
}
