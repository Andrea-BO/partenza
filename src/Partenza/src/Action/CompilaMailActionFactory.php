<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CompilaMailActionFactory
{
    public function __invoke(ContainerInterface $container) : CompilaMailAction
    {
        return new CompilaMailAction($container->get(TemplateRendererInterface::class));
    }
}
