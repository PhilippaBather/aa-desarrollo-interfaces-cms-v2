<?php

namespace controller;

use view\ViewManager;

/**
 * RutaController - dirige la autenticación de un usuario cuando accede a la aplicación.
 */
class RutaController
{
    public function __construct()
    {
    }

    public function comprobarAutenticacion(): ViewManager
    {
        $controller = new LoginController();
        $controller->comprobarAutenticacion();
        return $this->manejarRuta();
    }

    public function manejarRuta(): ViewManager
    {
        if (isset($_SESSION['is_logged_in'])) {
            if ($_SESSION['is_logged_in'] == 1) {
                return match ($_SESSION['rol']) {
                    ACCESO_RECHAZADO => new ViewManager('pages/login.php', new LoginController()),
                    ADMIN => new ViewManager('pages/admin-main.php', new AdminController()),
                    ESTUDIANTE => new ViewManager('pages/estudiante-main.php', new EstudianteController()),
                    PROFESOR => new ViewManager('pages/profesor-main.php', new ProfesorController())
                };
            }
        }

        return new ViewManager('pages/login.php', new LoginController());
    }
}