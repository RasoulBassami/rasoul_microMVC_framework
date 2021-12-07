<?php

namespace App\Core\Forms;

use App\Core\Model;

class Input extends Field{

    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_PASSWORD = 'password';

    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }

    public function passwordInput()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailInput()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function __toString()
    {
    
        $html = sprintf(
            '<div class="form-group">
                <label class="form-label">%s</label>
                %s
                %s
            </div>',
            $this->attribute,
            $this->renderInput(),
            $this->errorFeedback()
        );

        return $html;
    }

    public function renderInput() {

        return sprintf(
            '<input type="%s" name="%s" value="%s" class="form-control%s">',
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute} ?? '',
            $this->model->hasError($this->attribute) ? ' is-invalid' : ''
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