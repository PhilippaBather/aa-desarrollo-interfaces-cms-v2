<?php

namespace model;

/**
 * Admin - un administrador; extiende la clase Usuario
 */
class UAdmin extends Usuario
{

    /**
     * El sueldo del administrador
     * @var float
     */
    private $sueldo;

    public function __construct($rol, $nombre, $apellidos, $fechaNacimiento, $email, $sueldo)
    {
        parent::__construct($rol, $nombre, $apellidos, $fechaNacimiento, $email);
        $this->sueldo = floatval($sueldo);
    }

    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    public function getNombreUsuario(): string
    {
        return Usuario::getNombreUsuario();
    }

    public function getPassword(): string
    {
        return Usuario::getPassword();
    }
}