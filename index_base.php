<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use \App\Router;
use \App\Application;
use \App\Renderable;
use \App\View;

$router = new Router();

$router->get('/',     function() {
    return new View('index', ['title' => 'Index Page']);
});
$router->get('/about', function() {
    return 'about';
});

$application = new Application($router);

$application->run();
