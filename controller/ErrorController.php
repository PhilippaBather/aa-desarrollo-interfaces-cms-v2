<?php

namespace controller;

class ErrorController
{
    public static function setError($error)
    {
        $_SESSION['error'] = $error;
    }

    public static function unsetError()
    {
        if (isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        }
    }

}