<?php

namespace controller;

use exceptions\ValidationException;
use model\EstudianteModel;
use model\Post;
use model\Usuarios;
use utiles\Utiles;

/**
 * EstudianteController - el controlador para manejar, procesar y validar la entrada de los formularios de la vista
 * de Estudiantes.
 */
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
        $postTipo = Utiles::limpiarData($input['post-tipo']) ?? "";
        $titulo = Utiles::limpiarData($input['titulo']);
        $contenido = Utiles::limpiarData($input['contenido']);
        $fecha = date('Y-m-d'); // establecer la fecha actual

        // crear post
        $estudianteId = $_SESSION['id'];

        try {
            if (strlen($titulo) != 0 && strlen($contenido) != 0) {
                $estudiante = Usuarios::getUsuarioPorId($estudianteId);
                $newPost = new Post($estudiante->getNombreUsuario(), $titulo, $contenido, $fecha, $postTipo);
                $this->data['nuevo_post'] = $newPost;
            } else {
                throw new ValidationException(self::$error);
            }
        } catch (ValidationException $e) {
            $this->data['post_error'] = $e->getMessage();
        }
        return $this->data;
    }

    public function getData(): array
    {
        return EstudianteModel::getPosts();
    }

}