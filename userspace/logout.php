<?php

declare(strict_types=1);

require_once __DIR__ . '/functions.php';


session_destroy();

header('Location: ./login.php');
