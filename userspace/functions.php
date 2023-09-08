<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/BaseModel.php';

require_once __DIR__ . '/User.php';

function getPDO(): PDO
{
    static $pdo;

    return $pdo ??= new PDO(
        sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            'localhost',
            '3306',
            'ecf',
            'utf8mb4'
        ),
        'root',
        '',
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}

function salut(): void
{
    echo "Salut je m'appelle Aymeric.";
}
