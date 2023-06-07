<?php
namespace MyNamespace\Controller;
use PDO;

class ReviewsController
{
    public function reviews()
    {
        $errors = [];

        session_start();
        if (isset($_SESSION['email'])){
            return [
                '../View/reviews.html',
                1 => $errors
            ];

        }elseif(empty($_SESSION['email'])) {
            header('Location: /signup');
            die();
        }

    }

    public function reviewsCheck()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            session_start();

            $text = $_POST['text'];

            $DBH = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

            $sql = "select * from reviews where text = :text";
            $query = $DBH->prepare($sql);
            $query->execute(['text' => $text]);
            $DB = $query->fetch();
            print_r($DB);


            return [
                '../View/reviews.html',

            ];

        }

    }
}