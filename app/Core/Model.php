<?php

namespace App\Core;

abstract class Model {

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        return true;
    }

    
}