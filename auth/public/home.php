<?php

require_once __DIR__ . '/../../bootstrap.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require_once BASE_PATH . '/src/inc/bootstrap_lib.php'; ?>
</head>

<body>
    <main>
        <section class="d-flex justify-content-center align-items-center mx-auto py-5 my-5 w-100">
            <div class="p-3 m-3 shadow-lg">
                <h3>Hello <?= $_SESSION['username'] ?></h3>
                <h3>This is your email <?= $_SESSION['email'] ?></h3>
                <a href="logout.php">Click me to logout</a>
                (Work in progress ui)
            </div>

        </section>
    </main>
</body>

</html>