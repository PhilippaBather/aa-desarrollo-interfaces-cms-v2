<?php

namespace view;

use controller\ProfesorController;

class ProfessorView
{

    private $view;
    private $profController;

    public function __construct()
    {
        $this->view = 'pages/profesor-main.php';
        $this->profController = new ProfesorController();
    }

    public function pintarView()
    {
        return require($this->view);
    }

    public function manejarFormulario($input)
    {
        return $this->profController->manejarFormulario($input);
    }
}