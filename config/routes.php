<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {

    $middlewareComuniBase = [
        // Partenza\Middleware\ConfigAppMiddleware::class,
        // Partenza\Middleware\UrlHelperMiddleware::class,
    ];

    // $app->get('/', App\Handler\HomePageHandler::class, 'home');
    $app->get('/api/ping', App\Handler\PingHandler::class, 'api.ping');

    $app->get('/',
        [Partenza\Action\IndexAction::class],
        'home');

    $app->get('/pagina1',[Partenza\Action\Pagina1Action::class],'pagina1');

    $app->get('/pagina2',[Partenza\Action\Pagina2Action::class],'pagina2');

    $app->get('/pagina3',[Partenza\Action\Pagina3Action::class],'pagina3');

    $app->get('/compila-mail',
        [
        	Partenza\Middleware\ConfigAppMiddleware::class,
        	Partenza\Action\CompilaMailAction::class
        ],
        'compila_mail');

    $app->post('/compila-mail/invia-mail',
        [
            Partenza\Middleware\ConfigAppMiddleware::class,
            Partenza\Middleware\SendMailMiddleware::class,
            Partenza\Action\InviaMailAction::class
        ],
        'invia_mail');

};
