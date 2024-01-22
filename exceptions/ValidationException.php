<?php

namespace exceptions;

/**
 * ValidationException - clase de excepción personalizada para manejar excepciones de validación
 */
class ValidationException extends \Exception
{
    public function getValidationExceptionMessage()
    {
        return "Error de entrada: " . $this->getMessage();
    }
}