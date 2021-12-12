<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Models\User;
use App\Models\LoginForm;

class AuthController extends Controller {

    public function __construct()
    {
        $this->layout = 'auth';
    }

    public function login(Request $request)
    {

        $loginForm = new LoginForm();

        if ($request->isPost()) {

            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() and $loginForm->login()) {

                Application::$app->session->setFlashMessage('success', 'welcome to our site');
                Application::$app->response->redirect('/');
            }
        }

        return $this->render('login', ['model' => $loginForm]);
    }

    public function register(Request $request)
    {
        $userModel = new User();

        if ($request->isPost()) {

            $userModel->loadData($request->getBody());

            if ($userModel->validate() and $userModel->save()) {

                Application::$app->session->setFlashMessage('success', 'Thank you for registering.');
                Application::$app->response->redirect('/');
            }

            if ($userModel->validate()) {
                $userModel->decryptPassword();
            }
        }

        return $this->render('register', ['model' => $userModel]);
    }
    
}
