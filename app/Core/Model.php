<?php

namespace App\Core;

abstract class Model {

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public array $errors = [];

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules();

    public function validate()
    {
        /* rules = ['firstName' => [REQUIRED, [MAX, 'max' => 32]]]
            $attribute = 'firstName';
            $rule = [REQUIRED, [MAX, 'max' => 32]];
            $value = 'user input';
        */

        foreach($this->rules() as $attribute => $rules) {

            $value = $this->{$attribute};

            foreach($rules as $rule) {

                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED and !$value) {
                    $this->addError($attribute, $ruleName);
                }

                if($ruleName === self::RULE_EMAIL and !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, $ruleName);
                }

                if($ruleName === self::RULE_MIN and strlen($value) < $rule['min']) {
                    $this->addError($attribute, $ruleName, $rule);
                }

                if($ruleName === self::RULE_MAX and strlen($value) > $rule['max']) {
                    $this->addError($attribute, $ruleName, $rule);
                }

                if($ruleName === self::RULE_MATCH and $value !== $rule['match']) {
                    $this->addError($attribute, $ruleName, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    public function addError($attribute, $ruleName, $params = [])
    {
        $message = $this->errorMessages()[$ruleName] ?? '';
        foreach($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }
    
    public function errorMessages() {
        return [
            'required' => 'This field is required!',
            'email' => 'Please enter a valid email address.',
            'min' => 'This field cant be less than {min} characters.',
            'max' => 'This field cant be more than {max} characters.',
            'match' => 'This field should be same as {match}.',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}