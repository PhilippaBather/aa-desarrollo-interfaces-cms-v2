<?php

use model\Curso;
use model\Post;
use model\UAdmin;
use model\UEstudiante;
use model\UProfesor;

require "./model/constantes/cursos.php";
require "./model/constantes/roles.php";

/**
 * Globales - variables globales para representar datos de un base de datos.
 */

$usuarioAdmin = new UAdmin(ADMIN, "Iñaki", "Garcia", "dob",
    "inaki_garcia@educ.es", 27000.00);
$usuarioProfesor = new UProfesor(PROFESOR, "Andy", "MacDonald", "dob",
    "andy_mac@educ.es", 27000.00, []);
$usuarioEstudiante1 = new UEstudiante(ESTUDIANTE, "Elena", "Sanchez", "dob",
    "elena_munoz@educ.es", [ADVANCED_C1]);
$usuarioEstudiante2 = new UEstudiante(ESTUDIANTE, "David", "Vela", "dob",
    "david_vela@educ.es", [ADVANCED_C1]);
$usuarioEstudiante3 = new UEstudiante(ESTUDIANTE, "Lucas", "Gomez", "dob",
    "lucas_gomez@educ.es", [ADVANCED_C1]);

$postEvento = new Post("user667", "Xmas Fiesta", "Xmas party on 21st December.  Festive jumper a must.  Meet at Band on the Wall.", "15/12/2023", "Evento");
$postAnuncio = new Post("jake7", "C2 Proficiency Exam Book", "Si alguien quiere mis libros...¡acabo de aprobar el examen! :).", "15/12/2023", "Anuncio");

$curso1 = new Curso(CODE_ADVANCED_C1, ADVANCED_C1);
$curso1->setEstudiantes([$usuarioEstudiante1, $usuarioEstudiante2, $usuarioEstudiante3]);

global $usuariosLista;
$usuariosLista = [$usuarioAdmin, $usuarioEstudiante1, $usuarioEstudiante2, $usuarioProfesor];

global $postsLista;
$postsLista = [$postAnuncio, $postEvento];

global $cursosLista;
$cursosLista = [$curso1];