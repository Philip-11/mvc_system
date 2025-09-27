<?php

class User
{
    private $username;
    private $email;
    private $password;
    private $activation_code;
    static private $conn;
    private $userData;

    function __construct($conn)
    {
        self::$conn = $conn;
    }

    function is_user_active($user)
    {
        return (int)$user['active'] === 1;
    }

    function register($username, $email, $password, string $activation_code, int $expiry = 1 * 24 * 60 * 60): bool
    {
        $sql = "INSERT INTO accounts (username, email, password, activation_code, activation_expiry) VALUES (:username, :email, :password, :activation_code, :activation_expiry)";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'activation_code' => password_hash($activation_code, PASSWORD_DEFAULT),
            'activation_expiry' => date('Y-m-d H:i:s', time() + $expiry),
        ));

        return true;
    }

    function login($email, $password): bool
    {
        $sql = "SELECT * FROM accounts WHERE email=:email";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array(
            'email' => $email,
        ));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($user && $this->is_user_active($user) && password_verify($password, $user['password'])) {
            $this->userData = $user;
            return true;
        }

        return false;
    }

    function get()
    {
        $sql = "SELECT * FROM accounts";
        $stmt = self::$conn->query($sql);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function find_user_by_username(string $username)
    {
        $sql = "SELECT username, password, active, email FROM accounts WHERE username = :username";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array(
            'username' => $username,
        ));

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static function delete_user_by_id(int $id, int $active = 0)
    {
        $sql = "DELETE FROM accounts WHERE id = :id AND active = :active";
        $stmt = self::$conn->prepare($sql);

        return $stmt->execute(array(
            'id' => $id,
            'active' => $active,
        ));
    }

    static function find_unverified_user(string $activation_code, string $email)
    {
        $sql = "SELECT id, activation_code, activation_expiry < now() AS expired FROM accounts WHERE active = 0 AND email = :email";
        $stmt = self::$conn->prepare($sql);
        $stmt->execute(array(
            'email' => $email,
        ));

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            //already expired, delete the user with expired code
            if ((int)$user['expired'] === 1) {
                self::delete_user_by_id($user['id']);
                return null;
            }

            if (password_verify($activation_code, $user['activation_code'])) {
                return $user;
            }
        }
    }

    static function activate_user(int $user_id): bool
    {
        $sql = "UPDATE accounts SET active = 1, activated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = self::$conn->prepare($sql);

        return $stmt->execute(array(
            'id' => $user_id,
        ));
    }
}
