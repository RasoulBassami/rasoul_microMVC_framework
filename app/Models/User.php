<?php

namespace App\Models;

use App\Core\DbModel;

class User extends DbModel {

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;


    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;
    public int $status;

    public static function tableName() {
        return 'users';
    }

    public function attributes() {
        return ['firstName', 'lastName', 'email', 'password', 'status'];
    }

    public static function primaryKey () {
        return 'id';
    }
    
    public function displayName () {
        return $this->firstName . ' ' . $this->lastName;
    }


    public function rules()
    {
        return [
            'firstName' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 32]],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, 
                    [self::RULE_UNIQUE, 'class' => self::class]
                ],
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

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->status = self::STATUS_INACTIVE;
        return parent::save();
    }

    public function decryptPassword()
    {
        $this->password = $this->confirmPassword;
    }
}