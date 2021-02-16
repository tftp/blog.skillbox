<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\Route;
use App\Router;
use App\Application;
use App\Controller\UserController;
use App\Controller\CommentController;
use App\Controller\NoteController;
use App\Controller\SubscribeController;

$router = new Router();

$router->addRoute(new Route('GET', '/', NoteController::class . '@index'));
$router->addRoute(new Route('GET', '/notes/new', NoteController::class . '@new'));
$router->addRoute(new Route('POST', '/notes/new', NoteController::class . '@create'));
$router->addRoute(new Route('GET', '/notes/note/*', NoteController::class . '@show'));
$router->addRoute(new Route('POST', '/notes/note/*', CommentController::class . '@create'));

$router->addRoute(new Route('GET', '/registration', UserController::class . '@registrationGet'));
$router->addRoute(new Route('GET', '/users/*', UserController::class . '@show'));
$router->addRoute(new Route('POST', '/users/*', UserController::class . '@update'));
$router->addRoute(new Route('POST', '/registration', UserController::class . '@create'));
$router->addRoute(new Route('GET', '/authorization', UserController::class . '@authorizationGet'));
$router->addRoute(new Route('POST', '/authorization', UserController::class . '@authorizationPost'));
$router->addRoute(new Route('GET', '/exit', UserController::class . '@closeSession'));

$router->addRoute(new Route('POST', '/subscribe/update', SubscribeController::class . '@update'));

$router->addRoute(new Route('GET', '/test/*/test2/*', function ($param1, $param2) {
    echo "Test page with param = $param1 and $param2";
}));

$application = new Application($router);

$application->run();
