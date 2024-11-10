<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class PortFolioController extends Controller
{
    public function list(){
        return $this->view('portfolio/portfolios');
    }

    public function details()
    {
        return $this->view('portfolio/details_portfolio');
    }
}