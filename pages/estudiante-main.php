<?php

use view\EstudianteView;

$estudianteView = new EstudianteView();
$postsLista = $estudianteView->getData();

$postError = null;
$emailError = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_post'])) {
    $input = $_POST;
    $data = $estudianteView->manejarFormulario($input);

    if (!is_null($data['nuevo_post'])) {
        $postsLista[] = $data['nuevo_post'];
    }
    $postError = $data['post_error'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cerrar_correo'])) {
    $_SESSION['email'] = false;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enviar_correo'])) {
    $input = $_POST;
    $data = $estudianteView->manejarEmail($input);
    $emailError = $data['error_email'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/navigation.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/modal.css">
    <title>Education CMS</title>
</head>
<body>
<?php if (isset($_POST['email']) || $emailError): ?>
    <div class="modal_backdrop" id="modal_backdrop"></div>
    <div class="modal_container" id="modal_container">
        <form class="modal-form" method="post" name="enviar_email">
            <div class="modal-form_container">
                <h2 class="form-title">Enviar Correo</h2>
                <?php if (!is_null($emailError)): ?>
                    <p><?= $emailError; ?></p>
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
<?php endif; ?>
<?php
require "header.php";
?>

<main>
    <h1 class="dashboard_title">Estudiante Dashboard</h1>


    <section class="form_container">

        <?php require "estudiante-post-form.php";

        if (!is_null($postError)): ?>
            <p class="error-msg"><?= $postError; ?></p>

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

