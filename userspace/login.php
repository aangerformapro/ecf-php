<?php

declare(strict_types=1);

require_once __DIR__ . '/functions.php';


if (isset($_POST['email'], $_POST['password']))
{
    if ($user = User::connectUser($_POST['email'], $_POST['password']))
    {
        $_SESSION['user'] = $user->getId();
    }
}


if (isset($_SESSION['user']))
{
    header('Location: ./');

    exit;
}

ob_start();
?>

    <form method="post">
        <h1 class="mb-3">Se Connecter</h1>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
        <div class="my-3">
            <a href="./register.php">Créer un compte</a>
        </div>

    </form>




<?php

$body  = ob_get_clean();
$title = 'Connexion';

require __DIR__ . '/layout.php';
