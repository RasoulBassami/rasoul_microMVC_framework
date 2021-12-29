<?php
namespace App\Core\Middlewares;

use App\Core\Application;
use App\Core\Exceptions\AccessForbiddenException;

class AuthMiddleware extends BaseMiddleware {

    public function execute(){

        if(Application::isGuest()) {

            $current_action = Application::$app->controller->action;

            if (empty($this->actions) || in_array($current_action, $this->actions)) {
                Application::$app->controller->layout = 'main';
                throw new AccessForbiddenException();
            }
        }
    }
}