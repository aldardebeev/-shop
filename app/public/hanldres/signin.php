<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

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
    session_start();
    if (empty($errors)){
        $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

        $passUser = password_hash($password, PASSWORD_DEFAULT);

        $query = "select * from users where email= '$email'";
        $result = $DBH->query($query);
        $passDB = $result->fetch();

        if (password_verify($password, $passDB['password'])) {
            $_SESSION['email'] = $email;
            header("Location: /main");

        } else {
            echo "no ok";
        }
    }



}



require_once './view/signin.phtml';