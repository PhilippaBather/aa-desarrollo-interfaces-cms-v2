<?php

namespace exceptions;

class EmailException extends \Exception
{
    public function getEmailExceptionMessage()
    {
        return "Error de correo: " . $this->getMessage();
    }

}