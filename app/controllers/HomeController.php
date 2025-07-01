<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $model = $this->model('HomeModel');
        $data = $model->getMessage();
        $this->view('home/dashboard', ['message' => $data]);
    }

    public function dashboard()
    {
        $model = $this->model('HomeModel');
        $data = $model->getMessage();
        $this->view('home/dashboard', ['message' => $data]);
    }
}
