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

        if ($rol == "" || empty($nombre) || empty($apellido) || empty($fechaNac) || empty($email)) {
            $data['error'] = self::$error;
            return $data;
        }

        $isEmail = self::validarEmail($input['email']);
        $isFecha = self::validarFecha($input['fecha-nac']);
        if (empty($isEmail) || empty($isFecha)) {
            $errorMsg = self::crearMsgStr($isEmail, $isFecha);
            $data['error'] = self::$error . $errorMsg;
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
        return htmlspecialchars($input);
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


    private static function validarEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
    }

    private static function validarFecha($date): bool
    {
        $dateArr = explode('-',$date);
        $aa = $dateArr[0];
        $mm = $dateArr[1];
        $dd = $dateArr[2];

        // comprueba si el formato de la fecha está válida
        $isFormatoValid = checkdate($mm, $dd, $aa);

        $isValid = strtotime($date)<strtotime("today");

        return $isValid && $isFormatoValid; // si la fecha está correcta
    }

    private static function crearMsgStr($isEmail, $isFecha)
    {
        // Nota: false bools están cadenas vacias
        if (empty($isEmail) && empty($isFecha)){
            return ": email y fecha son inválidos.  Nota: una fecha en el pasado es requerido.";
        } else if(empty($isEmail)) {
            return ": email inváido";
        } else if(empty($isFecha)) {
            return ": fecha inválido.  Nota: una fecha en el pasado es requerido.";
        }
        return null;
    }

}