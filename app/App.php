<?php

use Controller\UserController;

class App
{
    private array $routes = [
        '/signup' => [
            'file' => '../Controller/UserController.php',
            'class' => '\Controller\UserController()',
            'method' => 'signup'
        ],
        '/signin' =>'./Controller/UserController.php',
        '/main'=> './hanldres/main.php'
    ];
    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$requestUri])) {
            #var_dump($this->routes[$requestUri]['file']);
            require_once $this->routes[$requestUri]['file'];
            $s = new UserController();
            $s->signup();

        } else {
            require_once './view/notFound.html';
        }
    }
}
