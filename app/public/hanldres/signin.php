<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $errors = validate($_POST);

    if (empty($errors)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

        $passUser = password_hash($password, PASSWORD_DEFAULT);

        $sql = "select * from users where email = :em";
        $query = $DBH->prepare($sql);

        $query->execute(['em' => $email]);

        $passDB = $query->fetch();


        if (password_verify($password, $passDB['password'])) {
            $_SESSION['email'] = $email;
            header("Location: /main");

        } else {
            $errors['email'] = 'The username or password is incorrect';
        }
    }
}
function validate (array $param): array
{
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
    return $errors;
}


require_once './view/signin.phtml';