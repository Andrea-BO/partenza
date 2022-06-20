<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class Pagina1ActionFactory
{
    public function __invoke(ContainerInterface $container) : Pagina1Action
    {
        return new Pagina1Action($container->get(TemplateRendererInterface::class));
    }
}
