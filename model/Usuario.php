<?php

namespace model;

/**
 * Usuario - un usuario de la aplicación
 */
class Usuario
{
    /**
     * Contador estático para asignar un ID
     * @var int
     */
    private static $contador = 1;

    /**
     * Identificador
     * @var string
     */
    private $id;

    /**
     * Rol del usuario para manejar permisos
     * @var string
     */
    private $rol;


    /**
     * Nombre del usuario para acceder el sitio
     * @var string
     */
    private $nombreUsuario;

    /**
     * Contraseña
     * @var string
     */
    private $password;

    /**
     * Nombre
     * @var string
     */
    private $nombre;

    /**
     * Apellido(s)
     * @var string
     */
    private $apellidos;

    /**
     * Fecha de nacimiento
     * @var string
     */
    private $fechaNacimiento;

    /**
     * Email
     * @var string
     */
    private $email;

    protected function __construct($rol, $nombre, $apellidos, $fechaNacimiento, $email)
    {
        $this->id = strval(self::$contador);
        $this->rol = $rol;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->email = $email;
        $this->nombreUsuario = strtolower($this->rol) . self::$contador;
        $this->password = "secret"; // por defecto para la primera parte de la entrega
        self::$contador++;  // aumenta para el próximo nombre del usuario
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getRol(): string
    {
        return strtoupper($this->rol);
    }

    public function getNombreUsuario(): string
    {
        return $this->nombreUsuario;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function getNombreYApellidos(): string
    {
        return $this->nombre . " " . $this->apellidos;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fechaNacimiento;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}