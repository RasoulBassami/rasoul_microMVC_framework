<?php

namespace App\Core;

class View {

    protected string $view_dir;
    protected string $public_dir;
    protected string $site_name;
    public string $title;

    public function __construct($root, $domain, $site_name)
    {
        $this->view_dir = $root . '/views/';
        $this->public_dir = $domain . '/public/';
        $this->site_name = $site_name;
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
        // $data can also contain a title
        $this->title = $title ?? $this->site_name;
        ob_start();
        include_once $this->view_dir . $view . '.php';
        return ob_get_clean();
    }

    public function renderLayout() {

        $layout = Application::$app->controller->layout ?? 'main';
        ob_start();
        include_once $this->view_dir . "/layouts/$layout.php";
        return ob_get_clean();
    }
}