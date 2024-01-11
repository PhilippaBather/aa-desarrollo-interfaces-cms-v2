<?php

namespace controller;

use model\EstudianteModel;
use model\Post;
use model\Usuarios;

class EstudianteController
{
    private static string $error = "Título y contenido requeridos.";

    private array $data;

    public function __construct()
    {
        $this->data = array(
            'post_error' => null,
            'nuevo_post' => null
        );
    }

    public function manejarFormularioEntregado($input): array
    {
        $postTipo = $this->limpiarData($input['post-tipo']) ?? "";
        $titulo = $this->limpiarData($input['titulo']);
        $contenido = $this->limpiarData($input['contenido']);
        $fecha = date('Y-m-d'); // establecer la fecha actual

        // crear post
        $estudianteId = $_SESSION['id'];

        if (!empty($titulo) || !empty($contenido)) {
            $estudiante = Usuarios::getUsuarioPorId($estudianteId);
            $newPost = new Post($estudiante->getNombreUsuario(), $titulo, $contenido, $fecha, $postTipo);
            $this->data['nuevo_post'] = $newPost;
            return $this->data;
        } else {
            $this->data['post_error'] = self::$error;
            return $this->data;
        }
    }

    public function getData(): array
    {
        return EstudianteModel::getPosts();
    }

    private function limpiarData($input): string
    {
        $input = trim($input);
        $input = stripslashes($input);
        return htmlspecialchars($input);
    }

}