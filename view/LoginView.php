<?php

namespace view;

/**
 * LoginView - dirige la vista de login/autenticación
 */
class LoginView
{

    private string $view;

    public function __construct()
    {
        $this->view = 'pages/login.php';
    }


    public function pintarView()
    {
        return require($this->view);
    }

}