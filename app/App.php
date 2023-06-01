<?php
namespace MyNamespace;
use MyNamespace\Controller\UserController as SignUpController;
use MyNamespace\Controller\UserController as SignInController;
use MyNamespace\Controller\MainController;



class App
{
    public function run()
    {
        $url = $_SERVER['REQUEST_URI'];

        if ($url === '/signup') {
            $controller = new SignUpController();
            $controller->signup();
        } elseif ($url === '/signin') {
            $controller = new SignInController();
            $controller->signin();
        } elseif ($url === '/main') {
            $controller = new MainController();
            $controller->main();
        } else {
            require_once './view/notFound.html';
        }
    }
}
