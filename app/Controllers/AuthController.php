<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Models\User;

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

        if ($request->isPost()) {
            return 'we should login user here!';
        }
    }

    public function register(Request $request)
    {

        if($request->isGet()) {

            return $this->render('register');
        }

        if ($request->isPost()) {

            $userModel = new User();
            $userModel->loadData($request->getBody());

            var_dump($userModel);die;
            if ($userModel->validate() and $userModel->register()) {
                return 'success';
            }
            return $this->render('register', ['model' => $userModel]);
        }
    }
    
}
