<?php

namespace App\Models;

use App\Core\Model;

class User extends Model {

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $confirmPassword;

    public function register()
    {
        return true;
    }
}