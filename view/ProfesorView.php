<?php

namespace view;

use controller\ProfesorController;

class ProfesorView
{

    private string $view;
    private ProfesorController $profController;

    public function __construct()
    {
        $this->view = 'pages/profesor-main.php';
        $this->profController = new ProfesorController();
    }

    public function pintarView()
    {
        return require($this->view);
    }

    public function manejarFormulario($input): array
    {
        return $this->profController->manejarFormulario($input);
    }
}