<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class AboutController extends Controller
{
    public function about(){
        return $this->view('about');
    }

}