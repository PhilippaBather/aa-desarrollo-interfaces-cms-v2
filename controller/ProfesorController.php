<?php

namespace controller;

use model\ProfesorModel;

class ProfesorController
{

    private $data;
    private ProfesorModel $profModel;

    public function __construct()
    {
        $this->data = array('error' => null);
        $this->profModel = new ProfesorModel();
    }

    public function manejarFormulario($input): void
    {
        // null coalescing operador (??): forma más corto del operador ternary introducido en PHP 7
        $estudiante_id = $input['estudiante-id'] ?? 0;
        $lectura = $input['lectura'] ?? 0;
        $escritura = $input['escritura'] ?? 0;
        $oral = $input['oral'] ?? 0;
        $auditiva = $input['auditiva'] ?? 0;
        $cod_curso = $input['cod_curso'];

        // TODO - validation and exceptions

        // obtener estudiante
        $estudiante = $this->getData($cod_curso, $estudiante_id);

        // establecer las notas
        $this->setNotas($estudiante, $lectura, $escritura, $oral, $auditiva);

    }

    private function getData($cod_curso, $estudiante_id): ?\model\UEstudiante
    {
        return $this->profModel->getEstudiante($cod_curso, $estudiante_id);
    }

    private function setNotas($estudiante, $lectura, $escritura, $oral, $auditiva): void
    {
        if (!is_null($estudiante)) {
            $estudiante->setNotas($lectura, $escritura, $oral, $auditiva);
            $estudiante->setPromedio();
        } else {
            // TODO - segunda entrega: excepciones
        }
    }


}