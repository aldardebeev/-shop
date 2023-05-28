<?php
// подключение к бд
$DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

if ($_SERVER['REQUEST_METHOD'] ===  "POST") {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = validate($_POST, $DBH);
    session_start();

    if (empty($errors)) {
        // хэш
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into users (username, email, password) values (:n, :ln, :pass)";
        $query = $DBH->prepare($sql);
        $query->execute(['n' => $username, 'ln' => $email,'pass' => $hash]);
        $_SESSION['email'] = $email;
        header("Location: /main");
    }
}

function validate (array $param, object $DBH): array
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    $sql = "select * from users where email = :em";
    $query = $DBH->prepare($sql);
    $query->execute(['em' => $email]);
    $DB = $query->fetch();

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
    if(!empty($DB)) {
        $errors['email'] = 'This email is already taken';
    }
    return $errors;
}

require_once './view/signup.phtml';
?>