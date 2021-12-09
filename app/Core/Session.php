<?php

namespace App\Core;

class Session
{
    public function __construct() {

        session_start();

        /* $_SESSION['flash_messages']['successfull register' => 
            [
                'remove' => false,
                'value' => 'welcome to our site'
            ]] */
        if(!empty($_SESSION['flash_messages'])) {
            foreach($_SESSION['flash_messages'] as $key => $flashMessage) {
                $_SESSION['flash_messages'][$key]['remove'] = true;
            }
        }
        
    }

    public function setFlashMessage(string $key, string $message)
    {
        $_SESSION['flash_messages'][$key] = 
            [
                'remove' => false,
                'value' => $message
            ];
    }

    public function getFlashMessage(string $key) {

        return $_SESSION['flash_messages'][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        if (!empty($_SESSION['flash_messages'])) {
            foreach ($_SESSION['flash_messages'] as $key => $flashMessage) {
                if ($flashMessage['remove']) {
                    unset($_SESSION['flash_messages'][$key]);
                }
            }
        }
    }

}