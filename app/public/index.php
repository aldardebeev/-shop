<?php
require_once '../Autoloader.php';
Autoloader::register(dirname(__DIR__));

use MyNamespace\App;

$app = new App();

$app->addRoute('/signup', \MyNamespace\Controller\UserController::class, 'signup');
$app->addRoute('/signin', \MyNamespace\Controller\UserController::class, 'signin');
$app->addRoute('/main', \MyNamespace\Controller\MainController::class, 'main');
$app->addRoute('/reviews', \MyNamespace\Controller\ReviewsController::class, 'reviews');

$app->run();


