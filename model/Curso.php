<?php

namespace model;

/**
 * Curso - el curso enseñado o inscrito
 */
class Curso
{

    /**
     * El código del curso
     * @var string
     */
    private $codigo;

    /**
     * El nombre del curso
     * @var string
     */
    private $nombre;

    /**
     * Una lista de los estudiantes matriculados
     * @var array
     */
    private $estudiantes;

    public function __construct($codigo, $nombre)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->estudiantes = array(); // inicializa un array vacío
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEstudiantes(): array
    {
        return $this->estudiantes;
    }

    public function setEstudiantes(array $estudiantes): void
    {
        $this->estudiantes = $estudiantes;
    }

    public function getEstudiantePorId($id): UEstudiante | null
    {
        foreach ($this->estudiantes as $estudiante) {
            if($estudiante->getId() == $id) {
                return $estudiante;
            }
        }
        return null;
    }

    public static function crearCurso(string $nivel): Curso
    {
        return match ($nivel) {
            "b1" => new Curso(CODE_LOWER_INTERMEDIATE_B1, LOWER_INTERMEDIATE_B1),
            "b2" => new Curso(CODE_INTERMEDIATE_B2, INTERMEDIATE_B2),
            "c1" => new Curso(CODE_ADVANCED_C1, ADVANCED_C1),
            "c2" => new Curso(CODE_PROFICIENCY_C2, PROFICIENCY_C2)
        };
    }

}