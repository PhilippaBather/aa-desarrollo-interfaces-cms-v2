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

    public static function manejarFormularioEntregado($input)
    {

        // si el botón de radio no está chequeado, no hay un valor, entonces, asigna una cadena vacía
        $rol = $input["rol"] ?? ""; // null coalescing operator (??); forma más corto del ternary: $rol = $_POST["rol"] ? $_POST["rol"] : "";
        $nombre = self::limpiarData($input["nombre"]);
        $apellido = self::limpiarData($input["apellidos"]);
        $fechaNac = self::limpiarData($input["fecha-nac"]);
        $email = self::limpiarData($input["email"]);
        $asignaturas = self::getAsignaturas($input);
        $sueldo = $input["sueldo"] ?? "0.0"; // si hay valor, asignalo; si no, asigna una cadena vacía

        // crea usuario:

        $data = array(
            "error" => null,
            "nuevoUsuario" => null
        );

        $data['error'] = self::validarEmail($input['email']);
        $data['error'] .= self::validarFecha($input['fecha-nac']);

        if ($rol == "" || empty($nombre) || empty($apellido) || empty($fechaNac) || empty($email)) {
            $data['error'] = self::$error;
            return $data;
        } else if (!empty(trim($data['error']))) {
            return $data;
        } else {
            // switch: crearUsuario usa una sentencia switch
            $nuevoUsuario = Usuarios::crearUsuario($rol, $nombre, $apellido, $fechaNac, $email, $asignaturas, $sueldo);
            $data['nuevoUsuario'] = $nuevoUsuario;
            return $data;
        }
    }

    public static function reestablecerFormulario()
    {
        Usuarios::unsetUsuario();
    }

    private static function limpiarData($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    private static function getAsignaturas($input)
    {
        $asignaturas = array();
        if (isset($input["asignaturas"])) {
            foreach ($_POST["asignaturas"] as $asignatura) {
                $asig = self::limpiarData($asignatura);
                $asignaturaCreada = Curso::crearCurso($asig);
                $asignaturas[] = $asignaturaCreada;
            }
        }
        return $asignaturas;
    }


    private static function validarEmail($email): ?string
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return null;
        } else {
            return self::$error . " - email inválido.";
        }
    }

    private static function validarFecha($date)
    {
        $dateArr = explode('-',$date);
        $aa = $dateArr[0];
        $mm = $dateArr[1];
        $dd = $dateArr[2];

        // comprueba si la fecha está válida
        $isValid = checkdate($mm, $dd, $aa);

        if (!$isValid) {
            return self::$error . " - fecha inválida.";
        }

        // comprueba si la fecha está en el pasado
        if(strtotime($date)>=strtotime("today")){
            return self::$error . " - fecha inválida: una fecha en el pasado es requerido.";
        }

        return null; // si la fecha está correcta
    }

}