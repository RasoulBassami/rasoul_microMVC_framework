<?php

namespace App\Core;

use App\Core\Application;

class Controller {

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }


}
