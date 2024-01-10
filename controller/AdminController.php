<?php

namespace controller;

use model\Curso;
use model\Usuarios;

class AdminController
{

    private static $error = "Detalles incompletas";

    public function __construct()
    {
    }

    public static function handleFormSubmission($input)
    {
        // si el botón de radio no está chequeado, no hay un valor, entonces, asigna una cadena vacía
        $rol = $input["rol"] ?? ""; // null coalescing operator (??); forma más corto del ternary: $rol = $_POST["rol"] ? $_POST["rol"] : "";
        $nombre = $input["nombre"];
        $apellido = $input["apellidos"];
        $fechaNacimiento = $input["fecha-nac"];
        $email = $input["email"];
        $asignaturas = array();

        // TODO - htmlspecialchars
        // TODO - validation: check email with regex
        // TODO - validation: ensure birthdate is a past date


            if (isset($input["asignaturas"])) {
                foreach ($_POST["asignaturas"] as $asignatura) {
                    $asignaturaCreada = Curso::crearCurso($asignatura);
                    $asignaturas[] = $asignaturaCreada;
                }
            }

        $sueldo = $input["sueldo"] ?? "0.0"; // si hay valor, asignalo; si no, asigna una cadena vacía

        // crea usuario:
        if ($rol == "" || empty($nombre) || empty($apellido) || empty($fechaNacimiento) || empty($email)) {
            ErrorController::setError(self::$error);
        } else {
            // switch: crearUsuario usa una sentencia switch
            $nuevoUsuario = Usuarios::crearUsuario($rol, $nombre, $apellido, $fechaNacimiento, $email, $asignaturas, $sueldo);
            ErrorController::unsetError();
            Usuarios::unsetUsuario();
            Usuarios::setUsuario($nuevoUsuario);
        }
    }

    public static function resetForm(){
        Usuarios::unsetUsuario();
    }
}