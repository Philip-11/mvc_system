<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';

$conn = Database::connect();
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $old_input = ['email' => $email];

    $user = new User($username, $email, $password, $conn);

    if ($user->login()) {
        session_regenerate_id();
        $data = $user->get();
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        echo "Success";
    } else {
        $_SESSION['errors'] = 'You have an incorrect email or password';
        $_SESSION['old_input'] = $old_input;
        header('Location: ' . BASE_URL . '/auth/public/login.php');
        exit;
    }
}
