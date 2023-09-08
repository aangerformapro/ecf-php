<?php

declare(strict_types=1);

require_once __DIR__ . '/functions.php';



if (isset($_POST['email'], $_POST['password'], $_POST['name']))
{
    if (
        $user = User::create([
            'email'    => $_POST['email'],
            'name'     => $_POST['name'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ])
    ) {

        $_SESSION['user'] = $user->getId();
        header('Location: ./');

        exit;
    }
}

if (isset($_SESSION['user']))
{
    header('Location: ./');

    exit;
}

ob_start(); ?>


    <form method="post">
        <h1 class="mb-3">Créer un compte</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
        <div class="my-3">
            <a href="./login.php">Se connecter</a>
        </div>

    </form>



<?php
$body  = ob_get_clean();
$title = 'Connexion';

require __DIR__ . '/layout.php';
