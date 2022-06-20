<?php

declare(strict_types=1);

namespace Partenza\Action;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class InviaMailActionFactory
{
    public function __invoke(ContainerInterface $container) : InviaMailAction
    {
        return new InviaMailAction($container->get(TemplateRendererInterface::class));
    }
}
