<?php

namespace controller;

use model\LoginModel;
use view\AdminView;
use view\EstudianteView;
use view\LoginView;
use view\ProfessorView;

/**
 * AutenticacionController - dirige la autenticación de un usuario cuando accede a la aplicación y la ruta que
 * corresponde al estado de autenticación y el rol del usuario.
 */
class AutenticacionController
{
    private LoginModel $loginModel;
    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function comprobarAutenticacion(): EstudianteView|ProfessorView|AdminView|LoginView
    {
        if (isset($_POST['login_submit'])) {
            $usuario = $_POST['username'];
            $password = $_POST['password'];

            $isAuthenticated = $this->loginModel->authenticateUser($usuario, $password);
            if ($isAuthenticated) {
                $this->setSession($usuario, $password);
                LoginErrorController::unsetError();
            } else {
                $error = "Detalles incorrectas; reintroduzca el usuario y la contraseña.";
                // TODO - return this as data to the view as with Admin and Student controllers
                LoginErrorController::setError($error);
            }
        } else if (isset($_POST['logout'])) {
            $this->deleteSession();
        }

        return $this->manejarRuta();
    }

    private function setSession($usuario, $password): void
    {
        $_SESSION['is_logged_in'] = 1;
        $rol = $this->loginModel->getRol($usuario, $password);
        $_SESSION['rol'] = $rol;
        $id = $this->loginModel->getId($usuario, $password);
        $_SESSION['id'] = $id;
    }

    private function deleteSession(): void
    {
        $_SESSION = array(); // vacia la matriz de datos de la sesión
        session_destroy(); // elimina todos datos de la sesión
    }

    public function manejarRuta(): EstudianteView|ProfessorView|AdminView|LoginView
    {
        if (isset($_SESSION['is_logged_in'])) {
            if ($_SESSION['is_logged_in'] == 1) {
                return match ($_SESSION['rol']) {
                    ACCESO_RECHAZADO => new LoginView(),
                    ADMIN => new AdminView(),
                    ESTUDIANTE => new EstudianteView(),
                    PROFESOR => new ProfessorView()
                };
            }
        }
        return new LoginView();
    }
}