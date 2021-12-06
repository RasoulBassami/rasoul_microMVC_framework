<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class AuthController extends Controller {

    public function __construct()
    {
        $this->layout = 'auth';
    }

    public function login(Request $request)
    {

        if($request->isGet()) {
            return $this->render('login');
        }

        return 'we should login user here!';  
    }

    public function showContactForm()
    {
        return $this->render('contact');
    }
    
}
