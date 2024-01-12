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
                $this->setSession($usuario, $password);
            } else {
                $error = "Detalles incorrectas; reintroduzca el usuario y la contraseña.";
                // TODO - return this as data to the view as with Admin and Student controllers
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
        $id = $this->model->getId($usuario, $password);
        $_SESSION['id'] = $id;
    }

    private function deleteSession()
    {
        $_SESSION = array(); // vacia la matriz de datos de la sesión
        session_destroy(); // elimina todos datos de la sesión
    }

}