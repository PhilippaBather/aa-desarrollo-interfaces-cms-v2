<?php

namespace view;

use controller\AdminController;

/**
 * AdminView - dirige la vista de administración.
 */
class AdminView
{

    private string $view;
    private AdminController $controller;

    public function __construct()
    {
        $this->view = 'pages/admin-main.php';
        $this->controller = new AdminController();
    }

    public function pintarView()
    {
        return require($this->view);
    }

    public function manejarFormulario($input): array
    {

        return $this->controller->manejarFormularioEntregado($input);
    }

}