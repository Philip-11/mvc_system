<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';

$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($username);
    $password = sanitize($username);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = new User($username, $password, $conn);

    if ($user->register()) {
        echo "Success";
    }
}
