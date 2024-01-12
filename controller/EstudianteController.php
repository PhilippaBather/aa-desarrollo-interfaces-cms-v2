<?php

namespace controller;

use exceptions\EmailException;
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

    public static function manejarEmail($input)
    {
        $to = $input['destinatario'];
        $subject = $input['asunto'];
        $msg = $input['mensaje'];

        $headers = 'From: pabdevtest@gmail.com' . "\r\n" .
            'Reply-To: pabdevtest@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $data = [
            'error' => null,
        ];

        // intentar enviar el correo
        try {
            if (!mail($to, $subject, $msg, $headers)) {
                throw new EmailException("Error al enviar correo.");
            }
        } catch (EmailException $ex) {
            $data['error'] = $ex->getMessage();
        } catch (\Exception $ex) {
            $data['error'] = $ex->getMessage();
        }

        return $data;
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