<?php

namespace model;

class ProfesorModel
{
    public function __construct()
    {
    }

    public function getEstudiante($cod_curso, $estudiante_id)
    {
        $curso = Cursos::getCursoPorCodigo($cod_curso);
        return $curso->getEstudiantePorId($estudiante_id);
    }
}