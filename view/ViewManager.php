<?php

namespace view;

class ViewManager
{

    private $view;
    private static $controller;

    public function __construct($view, $controller = null)
    {
        $this->view = $view;
        self::$controller = $controller;
    }


    public function pintarView()
    {
        return require($this->view);
    }

    public static function manejarFormularioEntregado($input)
    {
        return self::$controller->manejarFormularioEntregado($input);
    }

    public static function reestablecerFormulario()
    {
        self::$controller->reestablecerFormulario();
    }

}