<?php

$data = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_usuario'])) {
    $input = $_POST;
    $data = \view\ViewManager::manejarFormularioEntregado($input);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['despejar_confirmacion'])) {
    \model\Usuarios::unsetUsuario();
}

?>

<h1>Añadir Usuarios</h1>
<section class="form_container">
    <form class="form_manage-users" name="crear_usuario" method="post">
        <div>
            <input id="admin" name="rol" value="admin" type="radio" onchange="handleRoleSelection(this.id)"/>
            <label for="admin">Administrador</label>
            <input id="estudiante" name="rol" value="estudiante" type="radio" onchange="handleRoleSelection(this.id)"/>
            <label for="estudiante">Estudiante</label>
            <input id="profesor" name="rol" value="profesor" type="radio" onchange="handleRoleSelection(this.id)"/>
            <label for="profesor">Profesor</label>
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre">
        </div>
        <div>
            <label for="apellidos">Apellidos</label>
            <input id="apellidos" name="apellidos">
        </div>
        <div>
            <label for="fecha-nac">Fecha de nacimiento</label>
            <input id="fecha-nac" name="fecha-nac" type="date">
        </div>
        <div>
            <label for="email">Email</label>
            <input id="email" name="email"/>
        </div>
        <div id="detalles-asignatura" style="display:none">
            <p>Asignaturas:</p>
            <div>
                <input type="checkbox" id="b1" value="b1" name="asignaturas[]">
                <label for="b1">B1 Lower Intermediate</>
            </div>
            <div>
                <input type="checkbox" id="b2" value="b2" name="asignaturas[]">
                <label for="b2">B2 Intermediate</>
            </div>
            <div>
                <input type="checkbox" id="c1" value="c1" name="asignaturas[]">
                <label for="c1">C1 Advanced</>
            </div>
            <div>
                <input type="checkbox" id="c2" value="c2" name="asignaturas[]">
                <label for="c2">C2 Proficiency</>
            </div>
        </div>
        <div id="detalles-sueldo" style="display:none">
            <label for="sueldo">Sueldo</label>
            <input id="sueldo" name="sueldo"/>
        </div>
        <div class="form_btn-container">
            <button type="submit" name="crear_usuario">Añadir</button>
        </div>
    </form>
    <?php if (!is_null($data) && !is_null($data['error'])): ?>
        <p><?= $data['error']; ?></p>
    <?php endif; ?>
</section>

<section>
    <?php
    if (!is_null($data) && !is_null($data['nuevoUsuario'])):
        $nuevoUsuario = $data['nuevoUsuario']
        ?>
        <div class="form_container">
            <h1>Usuario Añadido</h1>
            <form class="form_response" name="despejar_confirmacion" method="post">
                <ul>
                    <li>Nombre: <?= $nuevoUsuario->getNombreYApellidos(); ?></li>
                    <li>Username: <?= $nuevoUsuario->getNombreUsuario(); ?></li>
                    <li>Fecha de Nacimiento: <?= $nuevoUsuario->getFechaNacimiento(); ?></li>
                    <li>Email: <?= $nuevoUsuario->getEmail(); ?></li>

                    <?php if ($nuevoUsuario->getRol() == ADMIN || $nuevoUsuario->getRol() == PROFESOR): ?>
                        <li>Sueldo: <?= $nuevoUsuario->getSueldo(); ?></li>
                    <?php endif; ?>
                    <?php if ($nuevoUsuario->getRol() == PROFESOR || $nuevoUsuario->getRol() == ESTUDIANTE): ?>
                        <li>Asignaturas:</li>
                        <ol>
                            <?php
                            $asignaturas = $nuevoUsuario->getCursos();
                            foreach ($asignaturas as $asignatura):
                                ?>
                                <li><?= $asignatura->getNombre(); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php endif; ?>
                </ul>
                <button class="form_btn" type="submit" name="despejar_confirmacion">OK</a></button>
            </form>
        </div>
    <?php endif; ?>
</section>