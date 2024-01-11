<?php

namespace exceptions;

class EmailException extends \Exception
{
    public function getMensaje()
    {
        return "EmailException Error: " . $this->getMessage();
    }

}