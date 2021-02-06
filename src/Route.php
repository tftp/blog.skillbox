<?php

namespace App;

class Route
{
    private $method;
    private $path;
    private $callback;

    public function __construct($method, $path, $callback)
    {
        $this->method = $method;
        $this->path = preparePath($path);
        $this->callback = $callback;
    }

    private function prepareCallback($callback)
    {
        if (is_string($callback)) {
            $callback = explode('@', $callback);
            return [new $callback[0], $callback[1]];
        } else {
            return $callback;
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function match($method, $uri)
    {
        $uri = preparePath($uri);
        $checkUriByTemplate = preg_match('/^' . str_replace(['*', '/'], ['\w+', '\/'], $this->getPath()) . '$/', $uri);

        return ($this->method === $method) && $checkUriByTemplate;
    }

    public function run($uri)
    {
        $callback = $this->callback;
        $params = array_diff(explode('/', $uri), explode('/', $this->getPath()));

        return call_user_func_array($this->prepareCallback($callback), $params);
    }
}
