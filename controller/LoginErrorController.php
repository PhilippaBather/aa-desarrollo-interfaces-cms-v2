<?php

namespace controller;

class LoginErrorController
{
    public static function setError($error): void
    {
        $_SESSION['error'] = $error;
    }

    public static function unsetError(): void
    {
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
    }

}