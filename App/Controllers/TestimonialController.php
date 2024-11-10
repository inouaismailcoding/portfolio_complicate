<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class TestimonialController extends Controller
{
    public function list(){
        return $this->view('testimonial/testimonials');
    }

    public function details()
    {
        return $this->view('testimonial/details_testimonial');
    }
}