<?php
namespace MyNamespace;
use MyNamespace\Controller\UserController;
use MyNamespace\Controller\MainController;

class App
{
    private array $routes = [];

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$url])){
            $class = $this->routes[$url][0];
            $method = $this->routes[$url][1];
            $route = new $class;
            $route->$method();
        }
        else{
            require_once './view/notFound.html';
        }
    }

    public function addRoute(string $route, string $class, string $method)
    {
        $this->routes[$route] = [$class, $method];
    }

}
