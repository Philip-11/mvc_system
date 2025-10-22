<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';
require_once BASE_PATH . '/src/libs/validator.php';

$conn = Database::connect();
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['id'];
    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = trim($_POST['password']);
    $password_again = trim($_POST['password2']);

    if ($msg = Validator::username($username)) $errors[] = $msg;
    if ($msg = Validator::email($email)) $errors[] = $msg;
    if ($msg = Validator::password($password, $password_again)) $errors[] = $msg;

    $user = new User($conn);

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ' . BASE_URL . '/auth/public/home.php');
        exit;
    }

    if ($user->update_user($user_id, $username, $email, $password)) {
        session_regenerate_id();
        $data = $user->get();
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];

        $msg = "Success";
        $info[] = $msg;
        $_SESSION['info'] = $info;

        header("Location: " . BASE_URL . "/auth/public/home.php");
        exit();
    } else {
        $_SESSION['errors'] = 'Please put correct email or password';
        $_SESSION['old_input'] = $old_input;
        header('Location: ' . BASE_URL . '/auth/public/home.php');
        exit;
    }
}
