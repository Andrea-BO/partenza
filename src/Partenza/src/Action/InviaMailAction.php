<?php

declare(strict_types=1);

namespace Partenza\Action;


use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class InviaMailAction implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;
    private $dati_mail;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $classe = 'InviaMailAction.php';
        // var_dump($classe, $request);
        // return        Void_::class;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'partenza::invia-mail',
            [
               'valori_campi' => $this->dati_modulo
            ] // parameters to pass to template
        ));
    }


}
