<?php
namespace MyNamespace\Controller;
use PDO;
class UserController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
    }

    public function signup()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] ===  "POST") {


            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = $this->validate($_POST);

            session_start();

            if (empty($errors)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "insert into users (username, email, password) values (:n, :ln, :pass)";

                $query = $this->pdo->prepare($sql);
                $query->execute(['n' => $username, 'ln' => $email,'pass' => $hash]);
                $_SESSION['email'] = $email;
                header("Location: /main");
            }
        }

        return [
            '../View/signup.phtml',
            1 => $errors

        ];
    }

    public function signin()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            session_start();
            $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
            $errors = $this->validateSignin($_POST, $DBH);

            if (empty($errors)){
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "select * from users where email = :em";
                $query = $DBH->prepare($sql);
                $query->execute(['em' => $email]);
                $DB = $query->fetch();



                if (password_verify($password, $DB['password'])) {
                    $_SESSION['email'] = $email;
                    header("Location: /main");
                }
            }
        }

        return [
            '../View/signin.phtml',
            1 => $errors
        ];
    }

    public function logout()
    {

        session_start();
        session_unset();
        session_destroy();
        header('Location: /signup');
        die();
    }
    protected function validate (array $params): array
    {
        $username = $params['username'];
        $email = $params['email'];
        $password = $params['password'];

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
        elseif (strlen($email) < 5){
            $errors['email'] = "the email cannot be less than 5 letters";
        }
        else{
            $sql = "select * from users where email = :em";
            $query = $this->pdo->prepare($sql);
            $query->execute(['em' => $email]);
            $DB = $query->fetch();
            if(!empty($DB)) {
                $errors['email'] = 'This email is already taken';
            }
        }
        if (empty($password) ) {
            $errors['password'] = "password required";
        }
        if (strlen($password) < 8){
            $errors['password'] = "The password must be at least 8 characters long";
        }
        return $errors;
    }

    protected function validateSignin (array $params): array
    {
        $email = $params['email'];
        $password = $params['password'];
        $errors = [];

        if (empty($email) ){
            $errors['email'] = "email required";
        }
        elseif (strlen($email) < 5){
            $errors['email'] = "the email cannot be less than 5 letters";
        }
        else{
            $sql = "select * from users where email = :em";
            $query = $this->pdo->prepare($sql);
            $query->execute(['em' => $email]);
            $DB = $query->fetch();

            if (empty($DB))
            {
                $errors['email'] = 'The email or password do not exit';
            }
        }
        if (empty($password) ) {
            $errors['password'] = "password required";
        }
        if (strlen($password) < 8){
            $errors['password'] = "The password must be at least 8 characters long";
        }
        return $errors;
    }

}
