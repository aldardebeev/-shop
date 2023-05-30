<?php

#use Controller\UserController;

class App
{
    private array $routes = [
        '/signup' => [
            'file' => '../Controller/UserController.php',
            'class' => 'UserController',
            'method' => 'signup'
        ],
        '/signin' => [
            'file' => '../Controller/UserController.php',
            'class' => 'UserController',
            'method' => 'signin'
        ],
        '/main' => [
            'file' => '../Controller/MainController.php',
            'class' => 'MainController',
            'method' => 'main'
        ],
        '/reviews' => [
            'file' => '../Controller/ReviewsController.php',
            'class' => 'ReviewsController',
            'method' => 'reviews'
        ]
    ];
    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$requestUri])) {
            $method = $this->routes[$requestUri]['method'];

            require_once $this->routes[$requestUri]['file'];
            $object = new $this->routes[$requestUri]['class'];
            $object->$method();

        } else {
            require_once './view/notFound.html';
        }
    }
}
