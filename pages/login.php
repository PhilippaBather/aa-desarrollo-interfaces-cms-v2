<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/main.css">
    <link rel="stylesheet" type="text/css" href="/pages/stylesheets/navigation.css">
    <title>Education CMS</title>
</head>
<body>
<?php
require "header.php";
?>
<main>
    <h1 class="dashboard_title">Login</h1>
    <div class="form_container">
        <form class="generic-form" name="login_submit" method="post">
            <label class="form-label" for="username">Usuario:</label>
            <input class="form-input" name="username" type="text" id="username">
            <label class="form-label" for="password">Contraseña:</label>
            <input class="form-input" type="password" name="password" id="password">
            <div>
                <button class="login-btn" name="login_submit" type="submit">Login</button>
            </div>
        </form>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-msg"><?= $_SESSION['error']; ?></p>
        <?php endif; ?>
    </div>
</main>
</body>
<?php
require "footer.php"
?>