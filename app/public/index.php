<?php
$requestUri = $_SERVER['REQUEST_URI'];


$routes = [
    '/signup' => './hanldres/signup.php',
    '/signin' =>'./hanldres/signin.php',
    '/main'=> './hanldres/main.php'
];

foreach ($routes as $key => $value){
    if ($key === $requestUri){
        require_once $value;
    }
}

?>



