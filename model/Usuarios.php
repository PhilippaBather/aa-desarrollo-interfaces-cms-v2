<?php

namespace model;

/**
 * Usuarios - la clase contiene funciones estáticas para manejar todos los usuariosLista contenidos en la variable
 * global $usuariosLista.
 */
class Usuarios
{
    public static function crearUsuario($rol, $nombre, $apellido, $fechaNacimiento, $email, $asignaturas, $sueldo)
    {
        $nuevoUsuario = null;
        // switch: crea al usuario según el rol introducido
        switch (strtoupper($rol)) { // porque el campo 'value' es en letra minúscula
            case ADMIN:
                $nuevoUsuario = new UAdmin($rol, $nombre, $apellido, $fechaNacimiento, $email, $sueldo);
                break;
            case ESTUDIANTE:
                $nuevoUsuario = new UEstudiante($rol, $nombre, $apellido, $fechaNacimiento, $email, $asignaturas);
                break;
            case PROFESOR:
                $nuevoUsuario = new UProfesor($rol, $nombre, $apellido, $fechaNacimiento, $email, $sueldo, $asignaturas);
                break;
        }
        return $nuevoUsuario;
    }

    public static function getUsuarioPorId($id)
    {
        global $usuariosLista;
        foreach ($usuariosLista as $usuario) {
            if ($usuario->getId() == $id) {
                return $usuario;
            }
        }
        return null;
    }

    public static function setUsuario($nuevoUsuario)
    {
        $_SESSION['nuevo_usuario'] = $nuevoUsuario;
    }

    public static function unsetUsuario()
    {
        if (isset($_SESSION['nuevo_usuario'])) {
            unset($_SESSION['nuevo_usuario']);
        }
    }
}