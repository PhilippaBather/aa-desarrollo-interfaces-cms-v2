<?php

namespace controller;

use exceptions\ValidationException;
use model\ProfesorModel;
use model\UEstudiante;
use utiles\Utiles;

class ProfesorController
{

    private $data;
    private ProfesorModel $profModel;

    public function __construct()
    {
        $this->data = array('error' => null);
        $this->profModel = new ProfesorModel();
    }

    public function manejarFormulario($input)
    {
        $estudiante_id = Utiles::limpiarData($input['estudiante-id']);
        $lectura = Utiles::limpiarData($input['lectura']);
        $escritura = Utiles::limpiarData($input['escritura']);
        $oral = Utiles::limpiarData($input['oral']);
        $auditiva = Utiles::limpiarData($input['auditiva']);
        $cod_curso = $input['cod_curso'];

        try {

            $estudiante = $this->getData($cod_curso, $estudiante_id);
            if (is_null($estudiante)) {
                throw new ValidationException("la ID del estudiante es inválida");
            }

            $nums = [$estudiante_id, $lectura, $escritura, $oral, $auditiva];
            if (empty(Utiles::validarNumeros($nums)) || empty(Utiles::validarRango($nums))) {
                throw new ValidationException("introduzca números entre 0 - 10 para las notas.");
            }

            // si estduiante existe, establece las notas
            $this->setNotas($estudiante, $lectura, $escritura, $oral, $auditiva);

        } catch (ValidationException $e) {
            $this->data['error'] = $e->getValidationExceptionMessage();
        }

        return $this->data;

    }

    private function getData($cod_curso, $estudiante_id): ?UEstudiante
    {
        return $this->profModel->getEstudiante($cod_curso, $estudiante_id);
    }

    private function setNotas($estudiante, $lectura, $escritura, $oral, $auditiva): void
    {
        $estudiante->setNotas($lectura, $escritura, $oral, $auditiva);
        $estudiante->setPromedio();
    }


}