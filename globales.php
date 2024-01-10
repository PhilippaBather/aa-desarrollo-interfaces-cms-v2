<?php

use model\UAdmin;
use model\UEstudiante;
use model\UProfesor;

require "./model/constantes/cursos.php";
require "./model/constantes/roles.php";

$usuarioAdmin = new UAdmin(ADMIN, "Iñaki", "Garcia", "dob",
    "inaki_garcia@educ.es", 27000.00);
$usuarioProfesor = new UProfesor(PROFESOR, "Andy", "MacDonald", "dob",
    "andy_mac@educ.es", 27000.00, []);
$usuarioEstudiante = new UEstudiante(ESTUDIANTE, "Elena", "Sanchez", "dob",
    "elena_munoz@educ.es", [ADVANCED_C1]);

global $usuariosLista;
$usuariosLista = [$usuarioAdmin, $usuarioEstudiante, $usuarioProfesor];