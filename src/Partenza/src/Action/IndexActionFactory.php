<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class IndexActionFactory
{
    public function __invoke(ContainerInterface $container) : IndexAction
    {
        return new IndexAction($container->get(TemplateRendererInterface::class));
    }
}
