<?php

declare(strict_types=1);

namespace Partenza\Middleware;

// use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AnalizzaMailMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {

        // $this->urlHelper = $request->getAttribute('url-helper');

        $this->dati_modulo = $request->getParsedBody();
        if(empty($this->dati_modulo))
            return 'dati_modulo EMPTY'; // new RedirectResponse($this->urlHelper->generate('home'));

        if(!isset($this->dati_modulo['tipo_modulo']))
            return 'dati_modulo NOT SET'; //new RedirectResponse($this->urlHelper->generate('home'));


        $response = $handler->handle($request);
        return $response;
    }
}
