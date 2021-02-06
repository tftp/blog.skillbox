<?php

namespace App;

class Router
{
    public $routes = [];

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
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
