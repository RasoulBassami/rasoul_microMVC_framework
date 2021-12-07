<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;


    public function rules()
    {
        return [
            'firstName' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 32]],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function labels() {
        return [
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email Address',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password'
        ];
    }

    public function register()
    {
        return true;
    }
}