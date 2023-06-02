<?php
namespace MyNamespace;
use MyNamespace\Controller\UserController;
use MyNamespace\Controller\MainController;

class App
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$_SERVER['REQUEST_METHOD']][$url])){
            $appRoute = ($this->routes[$_SERVER['REQUEST_METHOD']][$url]);
            list($class, $method ) = $appRoute;
            $route = new $class;
            list($view) = $route->$method();
            require_once $view;
        }
        else{
            require_once './view/notFound.html';
        }
    }

    public function get(string $route, string $class, string $method){
        $this->routes['GET'][$route] = [$class, $method];
    }
    public function post(string $route, string $class, string $method){
        $this->routes['POST'][$route] = [$class, $method];
    }
}
