<?php

define('BASE_PATH', __DIR__);

function sanitize($string): string
{
    $newString = trim(htmlspecialchars($string, ENT_HTML5, 'UTF-8'));

    return $newString;
}
