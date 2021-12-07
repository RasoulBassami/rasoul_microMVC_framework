<?php

namespace App\Core\Forms;

use App\Core\Model;

class Field {

    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
}