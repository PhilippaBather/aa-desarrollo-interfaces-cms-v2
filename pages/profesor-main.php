<?php

use model\Cursos;
use view\ProfesorView;

$curso = Cursos::getCursoPorCodigo(CODE_ADVANCED_C1);
$estudiantes = $curso->getEstudiantes();
$data = null;

$profView = new ProfesorView();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_notas'])) {
    $input = $_POST;
    $input['cod_curso'] = CODE_ADVANCED_C1;
    $data = $profView->manejarFormulario($input);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/navigation.css">
    <title>Education CMS</title>
</head>
<?php
require "header.php";
?>

<h1 class="dashboard_title">Profesor Dashboard</h1>

<section class="marks_container">
    <h1><?= $curso->getNombre(); ?></h1>

    <?php if (count($estudiantes) == 0): ?>
        <p>No hay estudiantes inscritos en este curso.</p>
    <?php else: ?>

        <table class="course-table_marks">
            <thead class="table_head">
            <tr class="table_head-row">
                <th class="table_head-row-header">ID</th>
                <th class="table_head-row-header">Nombre</th>
                <th class="table_head-row-header">Apellidos</th>
                <th class="table_head-row-header">Lectura</th>
                <th class="table_head-row-header">Escritura</th>
                <th class="table_head-row-header">Oral</th>
                <th class="table_head-row-header">Auditiva</th>
                <th class="table_head-row-header">Promedio</th>
                <th class="table_head-row-header"></th>
            </tr>
            <?php foreach ($estudiantes as $estudiante):
                $notas = $estudiante->getNotas();
                ?>
                <tr class="user_details_table-row">
                    <td class="row-item"><?= $estudiante->getID(); ?></td>
                    <td class="row-item"><?= $estudiante->getNombre(); ?></td>
                    <td class="row-item"><?= $estudiante->getApellidos(); ?></td>
                    <td class="row-item"><?= $notas["lectura"]; ?></td>
                    <td class="row-item"><?= $notas["escritura"]; ?></td>
                    <td class="row-item"><?= $notas["oral"]; ?></td>
                    <td class="row-item"><?= $notas["auditiva"]; ?></td>
                    <td class="row-item"><?= $notas["promedio"]; ?></td>
                </tr>
            <?php endforeach; ?>
            </thead>
        </table>
    <?php endif; ?>
</section>
<?php
if (!is_null($data) && isset($data['error'])): ?>
    <p class="error-msg"><?= $data['error']; ?></p>
<?php endif; ?>
<?php
require "profesor-form-notas.php";
?>

