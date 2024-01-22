<?php

namespace utiles;

/**
 * Utiles - la clase contiene funciones para validar la entrada de formularios.
 */
class Utiles
{

    public static function limpiarData($input): string
    {
        $input = trim($input);
        $input = stripslashes($input);
        return htmlspecialchars($input);
    }

    public static function validarEmail($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        } else {
            return false;
        }
    }

    public static function validarFecha($date): bool
    {
        $dateArr = explode('-',$date);
        $aa = $dateArr[0];
        $mm = $dateArr[1];
        $dd = $dateArr[2];

        // comprueba si el formato de la fecha está válida
        $isFormatoValid = checkdate($mm, $dd, $aa);

        $isValid = strtotime($date)<strtotime("today");

        return $isValid && $isFormatoValid; // si la fecha está correcta
    }

    public static function validarNumeros($nums): bool
    {
        foreach ($nums as $num) {
            if (!filter_var($num, FILTER_VALIDATE_INT)) {
                return false;
            }
        }
        return true;
    }

    public static function validarNumero($num) : bool
    {
        if (!filter_var($num, FILTER_VALIDATE_INT)) {
            return false;
        }
        return true;
    }

    /**
     * Comprueba si las notas dadas al alumno son válidas y, entonces,
     * entre 0 - 10.
     * @param $nums notas entradas
     * @return bool si está en el rango
     */
    public static function validarRango($nums): bool
    {
        foreach ($nums as $num) {
            if ($num < 0 || $num > 10) {
                return false;
            }
        }
        return true;
    }

}