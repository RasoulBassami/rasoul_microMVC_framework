<?php

namespace App\Core\Forms;

use App\Core\Model;

class Textarea extends Field{

    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
    }

    public function __toString()
    {
    
        $html = sprintf(
            '<div class="form-group">
                %s
                %s
                %s
            </div>',
            $this->renderLable(),
            $this->renderInput(),
            $this->errorFeedback()
        );

        return $html;
    }

    public function renderLable()
    {
        if(!empty($this->model->labels())) {
            $label = $this->model->labels()[$this->attribute] ?? $this->attribute;
            return sprintf('<label class="form-label">%s</label>', $label);  
        }
        return '';
    }

    public function renderInput() {

        return sprintf(
            '<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute} ?? ''
        );
    }

    public function errorFeedback()
    {
        if($this->model->hasError($this->attribute)) {
            $errorMessage = $this->model->getFirstError($this->attribute);
            return sprintf('<div class="invalid-feedback">%s</div>',  $errorMessage);
        }
        return '';
    }
}