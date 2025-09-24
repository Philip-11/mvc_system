<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';
require_once BASE_PATH . '/src/libs/validator.php';

$conn = Database::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = trim($_POST['password']);
    $old_input = ['email' => $email, 'username' => $username,];

    if ($msg = Validator::username($username)) $errors[] = $msg;
    if ($msg = Validator::email($email)) $errors[] = $msg;
    if ($msg = Validator::password($password)) $errors[] = $msg;

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $old_input;
        header('Location: ' . BASE_URL . '/auth/public/register.php');
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = new User($username, $email, $hashed_password, $conn);

    if ($user->register()) {
        echo "Success";
    }
}
