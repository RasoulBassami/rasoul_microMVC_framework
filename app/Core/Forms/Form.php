<?php

namespace App\Core\Forms;

use App\Core\Model;
use App\Core\Forms\Input;
use App\Core\Forms\Textarea;

class Form {

    public static function begin(string $action, string $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function input(Model $model, string $attribute)
    {
        return new Input($model, $attribute);
    }

    public function textarea(Model $model, string $attribute)
    {
        return new Textarea($model, $attribute);
    }

}