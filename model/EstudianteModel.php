<?php

namespace model;

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