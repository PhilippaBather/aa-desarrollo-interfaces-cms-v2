<?php

$isLoggedIn = false;

if(isset($_SESSION['is_logged_in'])){
    $isLoggedIn = true;
}

?>

<header class="header_container">
    <div class="header_container-company-details">
        <img class="company_details-logo-image" src="/pages/recursos/logo.jpg" alt="Logo de la academía"/>
        <h1 class="company_details-name">Trinity Academy</h1>
    </div>
    <?php if ($isLoggedIn): ?>
    <div>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
    <?php endif; ?>
</header>
