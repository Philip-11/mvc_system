<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once __DIR__ . '/../../bootstrap.php';
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/src/models/user.php';
require_once BASE_PATH . '/src/libs/validator.php';
require_once BASE_PATH . '/src/libs/Mailer.php';

$conn = Database::connect();
$mailer = new Mailer();

$activation_code = bin2hex(random_bytes(16));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = sanitize($_POST['username']);
    $email = sanitize($_POST['email']);
    $password = trim($_POST['password']);
    $password_again = trim($_POST['password2']);
    $old_input = ['email' => $email, 'username' => $username,];

    if ($msg = Validator::username($username)) $errors[] = $msg;
    if ($msg = Validator::email($email)) $errors[] = $msg;
    if ($msg = Validator::password($password, $password_again)) $errors[] = $msg;

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $old_input;
        header('Location: ' . BASE_URL . '/auth/public/register.php');
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user = new User($conn);


    $activation_link = "http://localhost/sirjay_system/auth/activate.php?email=$email&activation_code=$activation_code";

    if ($user->register($username, $email, $hashed_password, $activation_code)) {
        $mailer->sendTemplate(
            $email,
            "Verify your email",
            BASE_PATH . "/src/templates/emailTemplate.html",
            [
                "email" => $email,
                "verification_link" => $activation_link,
            ]
        );
        $msg = "Please check your email to activate before signing in";
        $info[] = $msg;
        $_SESSION['info'] = $info;
        header("Location: " . BASE_URL . "/auth/public/login.php");
        exit();
    }
}
