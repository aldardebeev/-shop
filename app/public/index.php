<?php
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri === '/singup') {
    require_once './hanldres/signup.php';
}
    elseif ($requestUri === '/singin'){
   require_once  './hanldres/signin.php';
}
elseif ($requestUri === '/main'){
    require_once  './hanldres/main.php';
}
?>



