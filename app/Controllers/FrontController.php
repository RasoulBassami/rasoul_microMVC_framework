<?php

namespace App\Controllers;

use App\Core\Controller;

class FrontController extends Controller {

    public function home()
    {
        return $this->render('home');
    }

    public function showContactForm()
    {
        return $this->render('contact');
    }
    
}
