<?php

namespace App\Models;

use App\Core\Model;

class ContactForm extends Model {

    public string $subject;
    public string $email;
    public string $body;

    public function rules()
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED]
        ];
    }

    public function labels() {
        return [
            'subject' => 'Subject',
            'email' => 'Your Email Address',
            'body' => 'Message'
        ];
    }

    public function send() {
        return true;
    }
}