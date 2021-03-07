<?php

namespace App;

use \App\Route;

class Router
{
    public $routes = [];

    public function addGet($uri, $method)
    {
        $this->routes[] = new Route('GET', $uri, $method);
    }

    public function addPost($uri, $method)
    {
        $this->routes[] = new Route('POST', $uri, $method);
    }

    public function findRoute($method, $url)
    {
        foreach ($this->routes as $route) {

            if ($route->match($method, $url)) {
                return $route;
            }
        }

        return null;
    }

    public function dispatch()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $route = $this->findRoute($method, $url);

        if ($route) {
            return $route->run($url);
        } else {
            throw new Exception\NotFoundException();
        }
    }
}
