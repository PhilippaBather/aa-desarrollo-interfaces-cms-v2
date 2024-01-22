<?php

namespace model;

/**
 * ProfesorModel - obtiene datos relevante al profesor de las globales (representando un base de datos).
 */
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