<?php
session_start();
if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

    $sql = "select * from users where email = :em";
    $query = $DBH->prepare($sql);
    $query->execute(['em' => $email]);
    $DB = $query->fetch();
    print_r($DB['username']);

    require_once './view/main.phtml';

}elseif(empty($_SESSION['email'])) {
    header('Location: /signin');
    die();
}


