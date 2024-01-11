<?php

require "init.php";

use controller\AutenticacionController;

// establece el controlador para comprobar autenticación
$load_controller = new AutenticacionController();
$load_view = $load_controller->comprobarAutenticacion();
// carga la vista depende del estado de autenticación
$load_view->pintarView();
