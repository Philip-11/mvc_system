<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';

$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = new User($username, $email, $hashed_password, $conn);

    if ($user->register()) {
        echo "Success";
    }
}
