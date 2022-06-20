<?php

declare(strict_types=1);

namespace Partenza\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class Pagina1Action implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        // Do some work...
        $this->renderer->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'pagina_uno', true
        );
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'partenza::pagina1',
            [] // parameters to pass to template
        ));
    }
}
