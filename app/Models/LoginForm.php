<?php

namespace App\Models;

use App\Core\Application;
use App\Core\DbModel;

class LoginForm extends DbModel {

    public string $email;
    public string $password;

    public static function tableName() {
        return 'users';
    }

    public function attributes() {
        return ['email', 'password'];
    }

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels() {
        return [
            'email' => 'Email Address',
            'password' => 'Password'
        ];
    }

    public function login() {

        $user = $this->findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'We can\'t find a user with that e-mail address');
            return false;
        }
        if(!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Incorrect password!');
            return false;
        }

        return true;
    }

}