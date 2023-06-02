<?php
require_once '../Autoloader.php';
Autoloader::register(dirname(__DIR__));

use MyNamespace\App;

$app = new App();

$app->get('/signup', \MyNamespace\Controller\UserController::class, 'signup');
$app->get('/signin', \MyNamespace\Controller\UserController::class, 'signin');
$app->get('/main', \MyNamespace\Controller\MainController::class, 'main');
$app->get('/reviews', \MyNamespace\Controller\ReviewsController::class, 'reviews');

$app->post('/signup', \MyNamespace\Controller\UserController::class, 'signup');
$app->post('/signin', \MyNamespace\Controller\UserController::class, 'signin');

$app->run();


