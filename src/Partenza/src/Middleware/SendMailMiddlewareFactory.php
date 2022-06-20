<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use Psr\Container\ContainerInterface;

class SendMailMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : SendMailMiddleware
    {
        // return new SendMailMiddleware();
        $configurazioneMail = $container->get('config')['mail'];

      //  $classe = 'AAA SendMailMiddlewareFactory';
      //  var_dump($classe, $configurazioneMail, $classe);
        //die($classe);
       //  return Void_::class;

        return new SendMailMiddleware($configurazioneMail);
    }
}
