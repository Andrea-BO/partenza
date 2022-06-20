<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use Partenza\Comuni\MailSenderService;
use Laminas\Diactoros\Response\RedirectResponse;
use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SendMailMiddleware implements MiddlewareInterface
{
   // private $configMail;
    private $dati_modulo;
    private $classe;
    // private $idRichiesta;

    public function __construct(array $configMail){
        $this->configMail = $configMail;
        $this->classe = 'CCC SendMailMiddleware.php';
      //  var_dump($configMail);
      //  var_dump($this->classe, $configMail, $this->classe);
      //  die($this->classe);
       // return  Void_::class; // $handler->handle($request);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {

        $classe = 'AAA SendMailMiddleware.php';
       //  var_dump($classe, $request, $classe, $handler, $classe);
       //  die($classe);
       //  return  Void_::class; // $handler->handle($request);

        $this->dati_modulo = $request->getParsedBody();

        $classe = 'SendMailMiddleware.php';
      //  var_dump($classe, $this->dati_modulo, $classe);
      //  die($classe);
        // return  Void_::class; // $handler->handle($request);

        //A// $nome = $this->dati_modulo['nome'];
        try{
            $mailSender = new MailSenderService($this->configMail);
            $esitoInvioMail = $mailSender->setBodyAndSend($this->dati_modulo);

            // loggo invio mail
           //  $this->salvaLogMail($esitoInvioMail);
        }catch(\Exception $e){
            // echo $e->getMessage();
            //  \Sentry\captureException($e);


            $response = $handler->handle($request);
            return $response;
        }

        $response = $handler->handle($request);
        return $response;

    }
}
