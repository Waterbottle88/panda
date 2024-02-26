<?php

namespace App\Controller;

use App\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('index');
    }
}