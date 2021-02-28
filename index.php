<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\Route;
use App\Router;
use App\Application;
use App\Controller\UserController;
use App\Controller\AdminUserController;
use App\Controller\AdminNoteController;
use App\Controller\AdminOptionController;
use App\Controller\CommentController;
use App\Controller\NoteController;
use App\Controller\SubscribeController;
use App\Controller\StaticPageController;

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
$router->addRoute(new Route('GET', '/subscribe/delete/*', SubscribeController::class . '@delete'));

$router->addRoute(new Route('GET', '/static/*', StaticPageController::class . '@show'));

$router->addRoute(new Route('GET', '/admin/users', AdminUserController::class . '@index'));
$router->addRoute(new Route('POST', '/admin/users/update', AdminUserController::class . '@update'));
$router->addRoute(new Route('GET', '/notes/update/*', AdminNoteController::class . '@show'));
$router->addRoute(new Route('POST', '/notes/update/*', AdminNoteController::class . '@update'));
$router->addRoute(new Route('GET', '/admin/options', AdminOptionController::class . '@index'));
$router->addRoute(new Route('POST', '/admin/options', AdminOptionController::class . '@update'));

$router->addRoute(new Route('GET', '/comments', CommentController::class . '@index'));
$router->addRoute(new Route('POST', '/comments/update', CommentController::class . '@update'));

$application = new Application($router);

$application->run();
