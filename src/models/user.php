<?php

class User {
    private $username;
    private $password;
    private $conn;
    private $userData;

    function __construct($username, $password, $conn)
    {
        $this->username = $username;
        $this->password = $password;
        $this->conn = $conn;
    }

    function register(): bool
    {
        $sql = "INSERT INTO accounts (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(
            'username' => $this->username,
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