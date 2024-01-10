<?php

namespace model;

/**
 * Estudiante - un estudiante matriculado; extiende la clase Usuario
 */
class UEstudiante extends Usuario
{

    /**
     * Asignaturas inscritas
     * @var array
     */
    private $cursos;

    /**
     * Array asociativa de notas
     * @var int[]
     */
    private $notas;

    public function __construct($rol, $nombre, $apellido, $fechaNacimiento, $email, $cursos)
    {
        parent::__construct($rol, $nombre, $apellido, $fechaNacimiento, $email);
        $this->cursos = $cursos;
        $this->notas = array(
            "lectura" => 0,
            "escritura" => 0,
            "oral" => 0,
            "auditiva" => 0,
            "promedio" => 0
        );
    }

    public function getNombreUsuario(): string
    {
        return Usuario::getNombreUsuario();
    }

    public function getPassword(): string
    {
        return Usuario::getPassword();
    }

    public function getCursos(): array
    {
        return $this->cursos;
    }

    public function getNotas(): array
    {
        return $this->notas;
    }

    public function setPromedio(): float
    {
        $sum = 0;
        foreach ($this->notas as $nota) {
            $sum += $nota;
        }

        $promedio = $sum / 4;
        $this->notas["promedio"] = $promedio;
        return $promedio;
    }

    public function setNotas($lectura, $escritura, $oral, $auditiva): void
    {
        $this->notas = array(
            "lectura" => $lectura,
            "escritura" => $escritura,
            "oral" => $oral,
            "auditiva" => $auditiva
        );
    }

}