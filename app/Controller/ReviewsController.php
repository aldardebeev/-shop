<?php
namespace MyNamespace\Controller;
use PDO;

class ReviewsController
{
    public function reviews()
    {
        require_once './view/reviews.html';
    }
}