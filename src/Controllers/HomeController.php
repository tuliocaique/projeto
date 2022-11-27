<?php

namespace App\Controllers;

use Projeto\Request;

class HomeController extends AppController
{

    public function index(Request $request)
    {
        return $this->view('home');
    }

}