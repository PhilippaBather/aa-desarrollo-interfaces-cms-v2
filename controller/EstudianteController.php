<?php

namespace controller;

use model\EstudianteModel;
use model\Post;
use model\Usuarios;

class EstudianteController
{
    private static $error = "Título y contenido requeridos.";
    public function __construct()
    {
    }
    public static function manejarFormularioEntregado($input)
    {
        $postTipo = self::limpiarData($input['post-tipo']) ?? "";
        $titulo = self::limpiarData($input['titulo']);
        $contenido = self::limpiarData($input['contenido']);
        $fecha = date('Y-m-d'); // establecer la fecha actual

        // crear post

        $data = array(
            "error" => null,
            "nuevoPost" => null
        );

        $estudianteId = $_SESSION['id'];

        if (!empty($titulo) || !empty($contenido)) {
            $estudiante = Usuarios::getUsuarioPorId($estudianteId);
            $newPost = new Post($estudiante->getNombreUsuario(), $titulo, $contenido, $fecha, $postTipo);
            $data['nuevoPost'] = $newPost;
            return $data;
        } else {
            $data['error'] = self::$error;
            return $data;
        }
    }

    public static function getData()
    {
        return EstudianteModel::getPosts();
    }

    private static function limpiarData($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        return htmlspecialchars($input);
    }

}