<?php
namespace MyNamespace\Controller;
use PDO;
class MainController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
    }
    public function main()
    {
        $errors = [];
        session_start();
        if (isset($_SESSION['email'])){
            $email = $_SESSION['email'];

            $sql = "select * from users where email = :em";
            $query = $this->pdo->prepare($sql);
            $query->execute(['em' => $email]);
            $DB = $query->fetch();

            return [
                '../View/main.phtml',
                1 => $errors
            ];

        }elseif(empty($_SESSION['email'])) {
            header('Location: /signup');
            die();
        }
    }
}