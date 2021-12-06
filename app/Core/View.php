<?php

namespace App\Core;

class View {

    protected string $view_dir;
    protected string $public_dir;

    public function __construct($root, $domain)
    {
        $this->view_dir = $root . '/views/';
        $this->public_dir = $domain . '/public/';
    }

    public function getPublicDir()
    {
        return $this->public_dir;
    }

    public function renderView(string $view, array $data = []) {

        $content = $this->renderContent($view, $data);
       
        $layout = $this->renderLayout();
        return str_replace('{{content}}', $content, $layout);
    }

    public function renderContent($view, $data) {

        extract($data);
        ob_start();
        include_once $this->view_dir . $view . '.php';
        return ob_get_clean();
    }

    public function renderLayout() {

        $layout = Application::$app->controller->layout;
        ob_start();
        include_once $this->view_dir . "/layouts/$layout.php";
        return ob_get_clean();
    }
}