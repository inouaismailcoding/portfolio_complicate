<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class ContactController extends Controller
{
    public function contact(){
        return $this->view('contact');
    }

}