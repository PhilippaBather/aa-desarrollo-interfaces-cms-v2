<?php

namespace model;

/**
 * EstudianteModel - obtener los posts en el archivo globales.php que representa datos de un base de datos.
 */
class EstudianteModel
{
    public static function getPosts()
    {
        $posts = array();
        global $postsLista;
        foreach ($postsLista as $post) {
            $posts[] = $post;
        }

        return $posts;
    }

}