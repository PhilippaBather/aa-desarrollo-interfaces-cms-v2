<?php

namespace model;

/**
 * Cursos - la clase contiene funciones estáticas para manejar una lista de cursos conteniendo en la variable global
 * $cursosLista
 */
class Cursos
{

    public static function getCursoPorCodigo($codigo) : Curso | null
    {

        global $cursosLista;
        for($i = 0; $i < $cursosLista; $i++) {
            if ($cursosLista[$i]->getCodigo() == $codigo) {
                return $cursosLista[$i];
            }
        }
        return null;
    }

    public static function getCursos($codigosCursos): array | null
    {
        if (count($codigosCursos) == 0) {
            return null;
        }

        $contador = 0;
        $cursos = [];
        do {
            $cursos[] = self::getCursoPorCodigo($codigosCursos[$contador]);
            $contador++;
        } while ($contador < count($codigosCursos));

        return $cursos;
    }

}