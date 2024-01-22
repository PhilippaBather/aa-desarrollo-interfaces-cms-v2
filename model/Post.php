<?php

namespace model;

use DateTime;

/**
 * Post - un mensaje publicado por un objeto Estudiante
 */
class Post
{
    /**
     * Contador estático para asignar un ID
     * @var int
     */
    private static $contador = 1;

    /**
     * Identificador
     * @var int
     */
    private $id;

    /**
     * Dueño del mensaje
     * @var UEstudiante
     */
    private $usuario;

    /**
     * Título del mensaje
     * @var string
     */
    private $titulo;

    /**
     * Fecha de creación del mensaje
     * @var DateTime
     */
    private $fecha;

    /**
     * Contenido del mensaje
     * @var string
     */
    private $contenido;

    /**
     * Tema del mensaje: anuncio o evento
     * @var string
     */
    private $tema;

    /**
     * @param $usuario
     * @param $titulo
     * @param $contenido
     * @param $fecha
     * @param $tema
     */
    public function __construct($usuario, $titulo, $contenido, $fecha, $tema)
    {
        $this->id = self::$contador;
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha = $fecha;
        $this->tema = $tema;
        self::$contador++;
    }

    public function getUsuario(): mixed
    {
        return $this->usuario;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }

    public function getTema(): string
    {
        return $this->tema;
    }

}