<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        include_once APP_PATH . '/views/pages/home.php';
    }
}