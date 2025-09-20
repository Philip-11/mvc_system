<?php

class User
{
    private $username;
    private $email;
    private $password;
    private $conn;
    private $userData;

    function __construct($username, $email, $password, $conn)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->conn = $conn;
    }

    function register(): bool
    {
        $sql = "INSERT INTO accounts (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        ));

        return true;
    }

    function get()
    {
        $sql = "SELECT * FROM accounts";
        $stmt = $this->conn->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
