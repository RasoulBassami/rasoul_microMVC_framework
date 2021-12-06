<?php

namespace App\Core;

class Request {

    public function getPath()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return ($this->method() === 'get') ?? false;
    }

    public function isPost()
    {
        return ($this->method() === 'post') ?? false;
    }

    public function getBody()
    {
        $body = [];

        if($this->isGet()) {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->isPost()) {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}