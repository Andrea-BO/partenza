<?php

declare(strict_types=1);

namespace Partenza\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class CompilaMailAction implements RequestHandlerInterface
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
        // $tipoModulo = 1;
        $numTelefonoInfo =  $request->getAttribute('configApp')['telefono_info']  ??  '012-345-678-90';
        // $servizi = $request->getAttribute('servizi')[$tipoModulo];
//A//        $parametri = $request->getAttribute('parametri');

        // Do some work...
        // $numTelefonoInfo =  '012-345-678-90';//  $request->getAttribute('configApp')['telefono_info'];

        $this->renderer->addDefaultParam(
            TemplateRendererInterface::TEMPLATE_ALL,
            'compila_mail', true
        );

        $classe = 'AAA CompilaMailAction.php';
        // var_dump($classe, $request, $classe, $this->renderer, $classe);
        // return Void_::class;

        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'partenza::compila-mail',
            [
                'telefono_info' => $numTelefonoInfo,
                // 'servizi' => $servizi,
                // 'tipo_modulo' => $tipoModulo,
                //'sys_error' => $parametri['system_error'] ?? null,
                //'errori_campi' => $parametri['err'] ?? [],
                'valori_campi' => $valori_campi ?? [],
            ] // parameters to pass to template
        ));
    }
}
