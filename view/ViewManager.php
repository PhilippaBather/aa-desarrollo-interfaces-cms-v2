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


    public function renderView()
    {
        return require($this->view);
    }

    public static function handleFormSubmission($input)
    {
        self::$controller->handleFormSubmission($input);
    }

    public static function resetForm()
    {
        self::$controller->resetForm();
    }

}