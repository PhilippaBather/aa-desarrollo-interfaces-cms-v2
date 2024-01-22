<?php

namespace controller;

use exceptions\ValidationException;
use model\Curso;
use model\Usuarios;
use utiles\Utiles;

/**
 * AdminController - el controlador para procesar y validar la entrada de los formularios la vista de Admin.
 */
class AdminController
{

    private static string $error = "Detalles incompletas";
    private array $data;

    public function __construct()
    {
        $this->data = array(
            "error" => null,
            "nuevoUsuario" => null
        );
    }

    public function manejarFormularioEntregado($input): array
    {
        // si el botón de radio no está chequeado, no hay un valor, entonces, asigna una cadena vacía
        $rol = $input["rol"] ?? ""; // null coalescing operator (??); forma más corto del ternary: $rol = $_POST["rol"] ? $_POST["rol"] : "";
        $nombre = Utiles::limpiarData($input["nombre"]);
        $apellido = Utiles::limpiarData($input["apellidos"]);
        $fechaNac = Utiles::limpiarData($input["fecha-nac"]);
        $email = Utiles::limpiarData($input["email"]);
        $asignaturas = $this->getAsignaturas($input);
        $sueldo = $input["sueldo"] ?? "0.0"; // si hay valor, asígnalo; si no, asigna "0.0"

        // crea usuario:

        try {
            if ($rol == "" || empty($nombre) || empty($apellido) || empty($fechaNac) || empty($email)) {
                throw new ValidationException(self::$error);
            }

            $isEmail = Utiles::validarEmail($input['email']);
            $isFecha = Utiles::validarFecha($input['fecha-nac']);
            if (empty($isEmail) || empty($isFecha)) {
                $errorMsg = self::crearMsgStr($isEmail, $isFecha);
                throw new ValidationException(self::$error . $errorMsg);
            }
            $isSueldo = Utiles::validarNumero($sueldo);
            if (empty($isSueldo)) {
                throw new ValidationException(self::$error . ": sueldo inválido");
            }

            $nuevoUsuario = Usuarios::crearUsuario($rol, $nombre, $apellido, $fechaNac, $email, $asignaturas, $sueldo);
            $this->data['nuevo_usuario'] = $nuevoUsuario;

        } catch (ValidationException $e) {
            $this->data['error'] = $e->getMessage();
            return $this->data;
        }

        return $this->data;
    }

    private function getAsignaturas($input): array
    {
        $asignaturas = array();
        if (isset($input["asignaturas"])) {
            foreach ($_POST["asignaturas"] as $asignatura) {
                $asig = Utiles::limpiarData($asignatura);
                $asignaturaCreada = Curso::crearCurso($asig);
                $asignaturas[] = $asignaturaCreada;
            }
        }
        return $asignaturas;
    }

    private function crearMsgStr($isEmail, $isFecha): ?string
    {
        // Nota: false bools están cadenas vacias
        if (empty($isEmail) && empty($isFecha)) {
            return ": email y fecha son inválidos.  Nota: una fecha en el pasado es requerido.";
        } else if (empty($isEmail)) {
            return ": email inválido";
        } else if (empty($isFecha)) {
            return ": fecha inválido.  Nota: una fecha en el pasado es requerido.";
        }
        return null;
    }

}