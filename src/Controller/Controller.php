<?php

namespace App\Controller;

class Controller
{
    protected function render($view, $data = [])
    {
        extract($data);
        include __DIR__. "/../View/$view.php";
    }
}