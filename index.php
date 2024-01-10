<?php

use controller\RutaController;

require "init.php";

// establece el controlador para comprobar autenticación
$load_controller = new RutaController();
$load_view = $load_controller->checkAuthentication();
// carga la vista depende del estado de autenticación
$load_view->renderView();
