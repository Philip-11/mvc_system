<?php
class Database
{
    private const DB_HOST = "localhost";
    private const DB_NAME = "users";
    private const DB_USER = "root";
    private const DB_PASS = "root";

    static function connect(): PDO
    {
        static $conn;

        if (!$conn) {
            $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $conn = new PDO($dsn, SELF::DB_USER, SELF::DB_PASS, $options);
        }

        return $conn;
    }
}
