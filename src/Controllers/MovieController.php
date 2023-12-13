<?php

namespace App\Controllers;

class MovieController
{
    public function index()
    {
        include_once APP_PATH . '/views/pages/movies.php';
    }
}