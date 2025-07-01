<?php

namespace App\Controllers;

use App\Core\Controller;
namespace App\Controllers;

use App\Core\Controller;

class CostingController extends Controller
{
    public function detailed()
    {
        $this->view('costing/detailed');
    }

    public function quick()
    {
        $this->view('costing/quick');
    }

    public function past()
    {
        $this->view('costing/past');
    }

    public function amazon()
    {
        $this->view('costing/amazon');
    }

    public function flipkart()
    {
        $this->view('costing/flipkart');
    }

    public function meesho()
    {
        $this->view('costing/meesho');
    }

    public function shopsy()
    {
        $this->view('costing/shopsy');
    }

    public function myntra()
    {
        $this->view('costing/myntra');
    }
}

class StockController extends Controller
{
    // ...
}
