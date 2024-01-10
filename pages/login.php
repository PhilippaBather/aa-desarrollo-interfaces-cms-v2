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

<div class="login-container">
    <h1 class="login-title">Login</h1>
    <form class="login-form" name="login_submit" method="post">
        <label class="login-label" for="username">Usuario:</label>
        <input class="login-input" name="username" type="text" id="username">
        <label class="login-label" for="password">Contraseña:</label>
        <input class="login-input" type="password" name="password" id="password">
        <div>
            <button class="login-btn" name="login_submit" type="submit">Login</button>
        </div>
        <form>
            <?php if (isset($_SESSION['error'])): ?>
                <p><?= $_SESSION['error']; ?></p>
            <?php endif; ?>
</div>

<?php
require "footer.php"
?>