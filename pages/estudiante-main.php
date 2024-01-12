<?php

use view\ViewManager;

$postsLista = ViewManager::getData();
$error = null;
$data = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_post'])) {
    $input = $_POST;
    $data = ViewManager::manejarFormulario($input);

    if (!is_null($data['nuevoPost'])) {
        $postsLista[] = $data['nuevoPost'];
    }
    $error = $data['error'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar_correo'])) {
    $_SESSION['email'] = false;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar_correo'])) {
    $input = $_POST;
    $data = ViewManager::manejarEmail($input);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/navigation.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/modal.css">
    <title>Education CMS</title>
</head>
<body>
<?php if (isset($_POST['email']) || isset($data['error'])): ?>
    <div class="model_overlay" id="modal_overlay"></div>
    <div class="modal_container" id="modal_container">
        <form class="modal-form" method="post" name="enviar_email">
            <div class="modal-form_container">
                <?php if(empty($data['isEnviado'])): ?>
                <h2 class="form-title">Enviar Correo</h2>
                <?php endif ?>
                <?php if(isset($data) && !is_null($data['error'])): ?>
                <p><?=$data['error']; ?></p>
                <?php endif; ?>
                <div class="modal-form_group">
                    <label for="destinatario">Destinatario:</label>
                    <input type="email" id="destinatario" name="destinatario" required>
                </div>
                <div class="modal-form_group">
                    <label for="asunto">Asunto:</label>
                    <input type="text" id="asunto" name="asunto" required>
                </div>
                <div class="modal-form_group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" rows="4" cols="40" required></textarea>
                </div>
                <div class="modal-form_btn">
                    <button type="submit" name="enviar_correo" id="btn_enviar">Enviar</button>
                </div>
            </div>
        </form>
        <form class="modal-form" method="post" name="cerrar_email">
            <button type="submit" name="cerrar_correo" id="btn_cancelar">Cancelar</button>
        </form>
    </div>
    </div>
<?php endif; ?>
<main>
    <?php
    require "header.php";
    ?>

    <h1>Estudiante Dashboard</h1>

    <section class="form_container">
        <form class="form_manage-users" method="post" name="crear_post">
            <h3>Post</h3>
            <div>
                <label for="post-select">Elige un tema</label>
                <select name="post-tipo" id="post-select">
                    <option value="Anuncio">Anuncios</option>
                    <option value="Evento">Eventos</option>
                </select>

            </div>
            <div>
                <label for="titulo">Título</label>
                <input id="titulo" name="titulo">
            </div>
            <div>
                <label for="contenido"></label>
                <textarea id="contenido" name="contenido" rows="4" cols="40"
                          placeholder="Escribe el post aquí"></textarea>
            </div>
            <div class="form_btn-container">
                <button type="submit" name="crear_post">Save</button>
            </div>
        </form>
        <?php if (!is_null($error)): ?>
            <p><?= $error; ?></p>
        <?php endif; ?>
    </section>

    <section>
        <?php foreach ($postsLista as $post): ?>
            <div class="post">
                <p><b><?= $post->getTema(); ?> <?= $post->getTitulo(); ?></b></p>
                <p><?= $post->getContenido(); ?></p>
                <p>Post por<?= $post->getUsuario(); ?> publicado <?= $post->getFecha(); ?></p>
            </div>
        <?php endforeach; ?>
    </section>
</main>
</body>
</html>

