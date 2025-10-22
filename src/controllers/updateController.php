<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';

$conn = Database::connect();
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['id'];
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = trim($_POST['password']);

    $user = new User($conn);

    if ($user->update_user($user_id, $username, $email, $password)) {
        session_regenerate_id();
        $data = $user->get();
        $_SESSION['username'] = $data['username'];
    }
}
