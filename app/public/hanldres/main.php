<?php
session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');


    $query = "select * from users where email= '$email'";
    $result = $DBH->query($query);
    $DB = $result->fetch();

    require_once './view/main.phtml';

}elseif(empty($_SESSION['email'])) {
    header('Location: /singin');
    die();
}


