<?php

namespace model;

require "globales.php";

/**
 * LoginModel - dirige autenticación, comprobando los datos de entrada cuando un usuario accede a la aplicación
 * contra las globales en vez de un base de datos
 */
class LoginModel
{

    /**
     * Comprueba el nombre del usuario y la contraseña contra la variable global $usuarioLista
     * en vez de un base de datos.
     * @param $username - nombre del usuario
     * @param $password - contraseña del usuario
     * @return bool - true si los datos son correctos; false si no
     */
    public function authenticateUser($username, $password)
    {
        // if username and password are equal to those contained in global
        global $usuariosLista;
        foreach ($usuariosLista as $usuario) {
            if ($usuario->getPassword() == $password) {
                if ($usuario->getNombreUsuario() == $username) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $username - nombre del usuario
     * @param $password - contraseña del usuario
     * @return string - rol del usuario
     */
    public function getRol($username, $password)
    {
        global $usuariosLista;
        foreach ($usuariosLista as $usuario) {
            if ($usuario->getPassword() == $password) {
                if ($usuario->getNombreUsuario() == $username) {
                    return $usuario->getRol();
                }
            }
        }
        return ACCESO_RECHAZADO;
    }
}