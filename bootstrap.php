<?php

define('BASE_PATH', __DIR__ . "/");
define('BASE_URL', "/sirjay_system");

function sanitize($text): string
{
    $newString = trim(htmlspecialchars($text, ENT_HTML5, 'UTF-8'));

    return $newString;
}
