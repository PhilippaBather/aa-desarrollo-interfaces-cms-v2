<?php

namespace exceptions;

class ValidationException extends \Exception
{
    public function getValidationExceptionMessage()
    {
        return "Error de entrada: " . $this->getMessage();
    }
}