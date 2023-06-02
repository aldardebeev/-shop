<?php
namespace MyNamespace\Controller;
use PDO;
class MainController
{
    public function main()
    {
        session_start();
        if (isset($_SESSION['email'])){
            $email = $_SESSION['email'];
            $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

            $sql = "select * from users where email = :em";
            $query = $DBH->prepare($sql);
            $query->execute(['em' => $email]);
            $DB = $query->fetch();

            return [
                '../View/main.phtml'
            ];

        }elseif(empty($_SESSION['email'])) {
            header('Location: /signup');
            die();
        }
    }
}