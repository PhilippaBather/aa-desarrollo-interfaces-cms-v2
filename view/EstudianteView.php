<?php

namespace view;

use controller\EmailController;
use controller\EstudianteController;

class EstudianteView
{

    private $view;
    private $estudianteController;
    private $emailController;

    public function __construct()
    {
        $this->view = 'pages/estudiante-main.php';
        $this->estudianteController = new EstudianteController();
        $this->emailController = new EmailController();
    }

    public function pintarView()
    {
        return require($this->view);
    }

    public function manejarFormulario($input)    {

        return $this->estudianteController->manejarFormularioEntregado($input);
    }

    public function manejarEmail($input)
    {
        return $this->emailController->manejarEmail($input);
    }

    public function getData()
    {
        return $this->estudianteController->getData();
    }

}