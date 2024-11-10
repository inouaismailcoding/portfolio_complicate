<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class BlogController extends Controller
{
    public function list(){
        return $this->view('blog/articles');
    }

    public function details()
    {
        return $this->view('blog/details_article');
    }
}