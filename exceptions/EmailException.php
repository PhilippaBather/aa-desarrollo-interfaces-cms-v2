<?php

namespace exceptions;

/**
 * EmailException - clase de excepción personalizada para manejar excepciones de enviar correos.
 */
class EmailException extends \Exception
{
    public function getEmailExceptionMessage()
    {
        return "Error de correo: " . $this->getMessage();
    }

}