<?php

namespace model;

/**
 * Profesor - un profesor que enseña un Curso; extiende la clase User
 */
class UProfesor extends Usuario
{
    /**
     * Sueldo
     * @var float
     */
    private $sueldo;

    /**
     * Array de los códigos de cursos enseñados
     * @var array de strings
     */
    private $codigosCursos;

    public function __construct($rol, $nombre, $apellidos, $fechaNacimiento, $email, $sueldo, $codigosCursos)
    {
        parent::__construct($rol, $nombre, $apellidos, $fechaNacimiento, $email);
        $this->sueldo = floatval($sueldo);
        $this->codigosCursos = $codigosCursos;
    }

    public function getNombreUsuario(): string
    {
        return Usuario::getNombreUsuario();
    }

    public function getPassword(): string
    {
        return Usuario::getPassword();
    }

    public function getSueldo(): float
    {
        return $this->sueldo;
    }

    public function getCursos(): array
    {
        return $this->codigosCursos;
    }

    public function setCursos($codigosCursos): void
    {
        $this->codigosCursos = $codigosCursos;
    }

}