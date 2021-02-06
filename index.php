<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use App\Route;
use App\Router;
use App\Application;
use App\Controller;

$router = new Router();

$router->addRoute(new Route('GET', '/', Controller::class . '@index'));
$router->addRoute(new Route('GET', '/about', Controller::class . '@about'));
$router->addRoute(new Route('GET', '/test/*/test2/*', function ($param1, $param2) {
    echo "Test page with param = $param1 and $param2";
}));

$application = new Application($router);

$application->run();
