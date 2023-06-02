<?php
namespace MyNamespace\Controller;
use PDO;

class ReviewsController
{
    public function reviews()
    {   session_start();
        if (isset($_SESSION['email'])){
            return [
                '../View/reviews.html'
            ];
        }elseif(empty($_SESSION['email'])) {
            header('Location: /signup');
            die();
        }
    }

    public function reviewsCheck()
    {
        session_start();
        $email = $_SESSION['email'];
        $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

        $sql = "select * from users where email = :em";
        $query = $DBH->prepare($sql);
        $query->execute(['em' => $email]);
        $DB = $query->fetch();
        print_r($DB['username']);
        return [
            '../View/reviews.html'
        ];
    }
}