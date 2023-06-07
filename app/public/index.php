<?php
require_once '../Autoloader.php';
Autoloader::register(dirname(__DIR__));

use MyNamespace\App;

$app = new App();

$object = new \MyNamespace\Controller\UserController();

$app->get('/signup', [\MyNamespace\Controller\UserController::class, 'signup']);
$app->get('/signin', [\MyNamespace\Controller\UserController::class, 'signin']);
$app->get('/main', [\MyNamespace\Controller\MainController::class, 'main']);
$app->get('/reviews', [\MyNamespace\Controller\ReviewsController::class, 'reviews']);
$app->get('/logout', [\MyNamespace\Controller\UserController::class, 'logout']);
$app->get('/product', [\MyNamespace\Controller\ProductController::class, 'product']);
$app->get('/shoppingCart', [\MyNamespace\Controller\ShoppingCart::class, 'shoppingCart']);

$app->post('/signup', [\MyNamespace\Controller\UserController::class, 'signup']);
$app->post('/signin', [\MyNamespace\Controller\UserController::class, 'signin']);
$app->post('/reviews', [\MyNamespace\Controller\ReviewsController::class, 'reviewsCheck']);
$app->post('/product', [\MyNamespace\Controller\ProductController::class, 'product']);


$app->run();


