<?php 

namespace App\Controllers;
use App\validation\validator;
use App\models\user;
use Core\Controller;
use Core\Logger;
use stdClass;

class PricingController extends Controller
{
    public function list(){
        return $this->view('pricing/pricings');
    }

    public function details()
    {
        return $this->view('pricing/details_pricing');
    }
}