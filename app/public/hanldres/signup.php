<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] ===  "POST") {
    $errors = validate($_POST);




    if (empty($errors)) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $st = $DBH->prepare("insert into users (username, email, password) values (:n, :ln, :pass)");
        $st->execute(['n' => $username, 'ln' => $email,'pass' => $hash]);
        $_SESSION['email'] = $email;
        header("Location: /main");
    }



}
function validate (array $param): array
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = [];

    if (empty($username) ){
        $errors['username'] = "username required";
    }
    if (strlen($username) < 3){
        $errors['username'] = "the user name cannot be less than 3 letters";
    }
    if (empty($email) ){
        $errors['email'] = "email required";
    }
    if (strlen($email) < 5){
        $errors['email'] = "the email cannot be less than 5 letters";
    }
    if (empty($password) ) {
        $errors['password'] = "password required";
    }
    if (strlen($password) < 8){
        $errors['password'] = "The password must be at least 8 characters long";
    }
    return $errors;
}

require_once './view/signup.phtml';
?>