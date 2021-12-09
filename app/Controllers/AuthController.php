<?php

namespace App\Controllers;

use App\Core\Application;
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

        $userModel = new User();

        if ($request->isPost()) {

            $userModel->loadData($request->getBody());

            if ($userModel->validate() and $userModel->save()) {

                Application::$app->session->setFlashMessage('success', 'welcome to our site');
                Application::$app->response->redirect('/');
            }

            if ($userModel->validate()) {
                $userModel->decryptPassword();
            }
        }

        return $this->render('register', ['model' => $userModel]);
    }
    
}
