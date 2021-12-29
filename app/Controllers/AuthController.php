<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Middlewares\AuthMiddleware;
use App\Core\Request;
use App\Models\User;
use App\Models\LoginForm;

class AuthController extends Controller {

    public function __construct()
    {
        $this->layout = 'auth';
        $this->registerMiddlewares(new AuthMiddleware(['profile']));
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

    public function logout() {
        Application::$app->logout();
        Application::$app->session->setFlashMessage('success', 'You have been successfully logged out.');
        Application::$app->response->redirect('/');
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

    public function profile(Request $request)
    {
        $this->layout = 'main';
        return $this->render('profile');
    }
    
}
