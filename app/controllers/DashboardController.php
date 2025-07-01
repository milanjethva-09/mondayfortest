<?php
namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $model = $this->model('HomeModel');          // reuse your existing model
        $data  = $model->getMessage();
        $this->view('home/dashboard', ['message' => $data]);
    }
}
