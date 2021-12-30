<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Request;
use App\Core\Controller;
use App\Models\ContactForm;

class FrontController extends Controller {

    public function home()
    {
        return $this->render('home');
    }

    public function contact(Request $request)
    {
        $contactForm = new ContactForm();
        if ($request->isPost()) {

            $contactForm->loadData($request->getBody());

            if ($contactForm->validate() and $contactForm->send()) {
                Application::$app->session->setFlashMessage('success', 'Thanks for cantacting.');
                Application::$app->response->redirect('/');
            }
        }

        return $this->render('contact', ['model' => $contactForm, 'title' => 'Contact Us']);
    }

}