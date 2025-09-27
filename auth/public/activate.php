<?php

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';

session_start();
$conn = Database::connect();
$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $email = sanitize($_GET['email']) ?? '';
    $activation_code = sanitize($_GET['activation_code']) ?? '';

    if (isset($activation_code) && !empty($activation_code)) {
        $user = User::find_unverified_user($activation_code, $email);

        if ($user && User::activate_user($user['id'])) {
            $msg = "Your account has been activated successfully. You can now login";
            $info[] = $msg;
            $_SESSION['info'] = $info;
            header("Location: login.php");
            exit();
        }
    }
}

$msg = 'The activation link is not valid, please register again';
$errors[] = $msg;
$_SESSION['errors'] = $errors;
header("Location: register.php");
exit();
