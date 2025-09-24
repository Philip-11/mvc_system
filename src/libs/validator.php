<?php

class Validator
{
    public static function username($username)
    {
        if (empty($username)) {
            return "Username is required";
        } elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
            return "Username must only contain letters, numbers and underscores";
        } elseif (strlen($username) < 3) {
            return "Username must be above 3 characters";
        }

        return null;
    }

    public static function email($email)
    {
        if (empty($email)) {
            return "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email format";
        }

        return null;
    }

    public static function password($password, $confirmPassword, $minLength = 8)
    {
        if (empty($password)) {
            return "Password is required";
        } elseif (strlen($password) < $minLength) {
            return "Password must be at least $minLength characters long";
        } elseif ($password !== $confirmPassword) {
            return "Password do not match";
        }

        return null;
    }
}
