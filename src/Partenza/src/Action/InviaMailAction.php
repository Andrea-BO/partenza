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
        // var_dump($classe, $this->renderer);
        // return        Void_::class;

        $dati_mail = $this->renderer['parsedBody'];  //  == NULL

        $classe = 'InviaMailAction.php';
        // var_dump($classe, $dati_mail,$classe);
        // var_dump($classe, $this->renderer, $classe);
        // die($classe);
         //die($classe . ' PHP ' . $dati_mail);
       //  return        Void_::class;


        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'partenza::invia-mail',
            [
               'valori_campi' => $dati_mail,
            ] // parameters to pass to template
        ));
    }


}
