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
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$url])){
            $callback = ($this->routes[$method][$url]);
            if(is_callable($callback)){
                echo $callback();
            }
            else{
                list($class, $method) = $callback;
                $object = new $class();
                list($view, $params) = $object->$method();

                extract($params);

                ob_start();
                require_once $view;
                $content = ob_get_clean();
                $layuot = file_get_contents('../View/layout.phtml');

                echo str_replace('{content}', $content, $layuot);
            }
        }
        else{
            require_once '../View/notFound.html';

        }
    }

    public function get(string $route, callable|array $callback): void
    {
        $this->routes['GET'][$route] = $callback;
    }

    public function post(string $route, callable|array $callback): void
    {
        $this->routes['POST'][$route] = $callback;
    }
}
