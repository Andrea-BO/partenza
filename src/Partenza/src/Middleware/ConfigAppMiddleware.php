<?php

declare(strict_types=1);

namespace Partenza\Middleware;

use phpDocumentor\Reflection\Types\Void_;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ConfigAppMiddleware implements MiddlewareInterface
{
    private $configApp;

    public function __construct(array $configApp){
        $this->configApp = $configApp;
    }
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $classe = 'AAA ConfigAppMiddleware.php';
        // var_dump($classe, $request, $classe, $this->configApp, $classe);
        // return Void_::class;

        // $response = $handler->handle($request);
        return $handler->handle($request->withAttribute('configApp', $this->configApp));
    }
}
