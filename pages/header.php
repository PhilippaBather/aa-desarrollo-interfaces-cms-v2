<?php

$isLoggedIn = false;
$rol = null;

if (isset($_SESSION['is_logged_in'])) {
    $isLoggedIn = true;
}

if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}

?>

<header class="header_container">
    <div class="header_container-company-details">
        <img class="company_details-logo-image" src="/pages/recursos/logo.jpg" alt="Logo de la academía"/>
        <h1 class="company_details-name">Trinity Academy</h1>
    </div>
    <div class="header_container-actions">
    <?php if ($rol == ESTUDIANTE): ?>
        <div>
            <button type="button" name="email">Email Profesor</button>
        </div>
    <?php endif; ?>
    <?php if ($isLoggedIn): ?>
        <div>
            <form method="post">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    <?php endif; ?>
    </div>
</header>
