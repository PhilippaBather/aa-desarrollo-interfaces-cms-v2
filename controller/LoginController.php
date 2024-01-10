<?php

namespace controller;

use model\LoginModel;

class LoginController
{

    private $model;
    public function __construct()
    {
        $this->model = new LoginModel();
    }

    public function comprobarAutenticacion()
    {
        if (isset($_POST['login_submit'])) {
            $usuario = $_POST['username'];
            $password = $_POST['password'];

            $isAuthenticated = $this->model->authenticateUser($usuario, $password);
            if ($isAuthenticated) {
                // TODO - get other useful session details e.g., classes taught or enrolled upon, marks
                $this->setSession($usuario, $password);
            } else {
                $error = "Detalles incorrectas; reintroduzca el usuario y la contraseña.";
                ErrorController::setError($error);
            }
        } else if (isset($_POST['logout'])) {
            $this->deleteSession();
        }
    }

    private function setSession($usuario, $password)
    {
        $_SESSION['is_logged_in'] = 1;
        $rol = $this->model->getRol($usuario, $password);
        $_SESSION['rol'] = $rol;

        ErrorController::unsetError();
    }

    private function deleteSession()
    {
        $_SESSION = array(); // vacia la matriz de datos de la sesión
        session_destroy(); // elimina todos datos de la sesión
    }

}