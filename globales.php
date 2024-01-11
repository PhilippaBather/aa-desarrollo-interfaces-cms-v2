<?php

use model\Post;
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

$postEvento = new Post("user667", "Xmas Fiesta", "Xmas party on 21st December.  Festive jumper a must.  Meet at Band on the Wall.", "15/12/2023", "Evento");
$postAnuncio = new Post("jake7", "C2 Proficiency Exam Book", "Si alguien quiere mis libros...¡acabo de aprobar el examen! :).", "15/12/2023", "Anuncio");


global $usuariosLista;
$usuariosLista = [$usuarioAdmin, $usuarioEstudiante, $usuarioProfesor];

global $postsLista;
$postsLista = [$postAnuncio, $postEvento];