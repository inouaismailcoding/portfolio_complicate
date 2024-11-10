<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class TeamController extends Controller
{
    public function list(){
        return $this->view('team/teams');
    }

    public function details()
    {
        return $this->view('team/details_teams');
    }
}