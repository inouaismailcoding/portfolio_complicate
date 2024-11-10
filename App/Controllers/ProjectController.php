<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class ProjectController extends Controller
{
    public function list(){
        return $this->view('project/projects');
    }

    public function details()
    {
        return $this->view('project/details_project');
    }
}