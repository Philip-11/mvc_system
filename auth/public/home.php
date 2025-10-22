<?php

require_once __DIR__ . '/../../bootstrap.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require_once BASE_PATH . '/src/inc/bootstrap_lib.php'; ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->
</head>

<body class="">
    <main class="m-auto">
        <div class="container">
            <nav class="d-flex justify-content-center px-8 py-3">
                <ul class="col-3 nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="">Profile</a></li>
                </ul>
                <h3 class="col-3"><?php echo "Hello " . $_SESSION['username'] . "!" ?></h3>
                <ul class="col-3 nav nav-pills">
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <?php
        if (isset($_SESSION['errors'])):
            foreach ($_SESSION['errors'] as $error):
        ?>
                <div class="d-flex justify-content-center alert alert-danger alert-dismissable" role="alert">
                    <div><?php echo $error ?></div>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
            endforeach;
            unset($_SESSION['errors']);
        endif;
        ?>
        <?php
        if (isset($_SESSION['info'])):
        ?>
            <?php foreach ($_SESSION['info'] as $info): ?>
                <div class="d-flex justify-content-center alert alert-info alert-dismissable" role="alert">
                    <div><?php echo $info ?></div>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php
            endforeach;
            unset($_SESSION['info']);
        endif;
        ?>
        <section class="flex justify-center items-center mt-9 ">
            <div class="text-white py-4 p-9 m-3 mt-9 rounded shadow-lg">
                <h2 class="text-center font-semibold text-2xl mb-3">Update your details</h2>
                <form class="" action="<?php echo BASE_URL; ?>/src/controllers/updateController.php" method="POST">
                    <div class="form-floating">
                        <input class="form-control" type="email" name="email" id="email" value="<?= $_SESSION['email'] ?>">
                        <label class="font-bold" for="email">Email</label>

                    </div>

                    <div class="form-floating">
                        <input class="form-control" type="text" name="username" id="username" value="<?= $_SESSION['username'] ?>">
                        <label class="font-bold" for="username">Username</label>

                    </div>

                    <div class="form-floating">
                        <input class="form-control" type="password" name="password" id="" required>
                        <label class="font-bold" for="password">Password</label>



                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="password2" id="" required>
                        <label class="font-bold" for="password2">Password Again</label>



                    </div>

                    <div class="flex justify-center items-center">
                        <button class="btn btn-primary w-100" type="submit">Update</button>
                    </div>
                </form>

            </div>

        </section>
    </main>
</body>

</html>