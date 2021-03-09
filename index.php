<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\Router;
use App\Application;
use App\Controller\UserController;
use App\Controller\ForAuthorizedUserController;
use App\Controller\AdminUserController;
use App\Controller\ModerateNoteController;
use App\Controller\AdminOptionController;
use App\Controller\ModerateCommentController;
use App\Controller\CommentController;
use App\Controller\NoteController;
use App\Controller\SubscribeController;
use App\Controller\ForAuthorizedSubscribeController;
use App\Controller\StaticPageController;
use App\Controller\PrivateController;

$router = new Router();

$router->addGet('/', NoteController::class . '@index');

$router->addGet('/notes/new', ModerateNoteController::class . '@new');
$router->addPost('/notes/new', ModerateNoteController::class . '@create');
$router->addGet('/notes/note/*', NoteController::class . '@show');
$router->addPost('/notes/note/*', CommentController::class . '@create');

$router->addGet('/users/*', ForAuthorizedUserController::class . '@show');
$router->addPost('/users/*', ForAuthorizedUserController::class . '@update');
$router->addGet('/registration', UserController::class . '@new');
$router->addPost('/registration', UserController::class . '@create');
$router->addGet('/authorization', UserController::class . '@authorizationGet');
$router->addPost('/authorization', UserController::class . '@authorizationPost');
$router->addGet('/exit', PrivateController::class . '@closeSession');

$router->addPost('/users/subscribe/update', ForAuthorizedSubscribeController::class . '@update');
$router->addPost('/subscribe/update', SubscribeController::class . '@update');
$router->addGet('/subscribe/delete/*', SubscribeController::class . '@delete');

$router->addGet('/static/*', StaticPageController::class . '@show');

$router->addGet('/admin/users', AdminUserController::class . '@index');
$router->addPost('/admin/users/update', AdminUserController::class . '@update');
$router->addGet('/notes/update/*', ModerateNoteController::class . '@show');
$router->addPost('/notes/update/*', ModerateNoteController::class . '@update');
$router->addGet('/admin/options', AdminOptionController::class . '@index');
$router->addPost('/admin/options', AdminOptionController::class . '@update');

$router->addGet('/comments', ModerateCommentController::class . '@index');
$router->addPost('/comments/update', ModerateCommentController::class . '@update');

$application = new Application($router);

$application->run();
