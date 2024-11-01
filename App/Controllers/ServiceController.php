<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class ServiceController extends Controller
{
    public function list(){
        return $this->view('service/services');
    }

    public function details()
    {
        return $this->view('service/details_service');
    }
}