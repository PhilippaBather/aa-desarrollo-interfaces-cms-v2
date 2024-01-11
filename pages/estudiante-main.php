<?php

$postsLista = \view\ViewManager::getData();
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_post'])) {
    $input = $_POST;
    $data = \view\ViewManager::manejarFormularioEntregado($input);

    if (!is_null($data['nuevoPost'])) {
        $postsLista[] = $data['nuevoPost'];
    }
    $error = $data['error'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/navigation.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/login.css">
    <title>Education CMS</title>
</head>

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

