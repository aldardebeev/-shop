<?php

namespace MyNamespace\Controller;
use PDO;
class ProductController
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
    }
    public function product()
    {
        session_start();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] ===  "POST") {
            $post = array_flip($_POST);
            $post = $post[null];
            print_r($post);


            if ($post == 'iphone'){
                echo "yes";
            }


        }
        return [
            '../View/product.html',
            1 => $errors
        ];
    }
}