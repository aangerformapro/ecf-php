<?php

declare(strict_types=1);

require_once __DIR__ . '/functions.php';

if ( ! isset($_SESSION['user']))
{
    header('Location: ./login.php');

    exit;
}

$user  = unserialize($_SESSION['user']);



// salut();

ob_start();
?>

<h1>Bonjour <?= $user; ?></h1>

<p class="my-3 pt-3">
    <a href="./logout.php" class="btn btn-primary">
        Se Déconnecter
    </a>
</p>

<?php
$body  = ob_get_clean();

$title = 'Bienvenue';

require __DIR__ . '/layout.php';
