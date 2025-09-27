<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once __DIR__ . '/../../bootstrap.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require_once BASE_PATH . '/src/inc/bootstrap_lib.php'; ?>
</head>

<body>
    <main class="">
        <section class="d-flex flex-column justify-content-center align-items-center mx-auto py-5 my-5 w-100">
            <?php
            if (isset($_SESSION['errors'])):
            ?>
                <div class="d-flex justify-content-end alert alert-danger alert-dismissable" role="alert">
                    <div><?php echo $_SESSION['errors'] ?></div>
                    <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['errors']);
            endif;
            ?>

            <?php
            if (isset($_SESSION['info'])):
            ?>
                <?php foreach ($_SESSION['info'] as $info): ?>
                    <div class="d-flex justify-content-end alert alert-info alert-dismissable" role="alert">
                        <div><?php echo $info ?></div>
                        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php
                endforeach;
                unset($_SESSION['info']);
            endif;
            ?>
            <form class="shadow-lg p-5 rounded" action="<?php echo BASE_URL; ?>/src/controllers/loginController.php" method="POST">
                <h1 class="h1 fw-bold text-center">Login</h1>

                <div class="form-floating">
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                    <label for="email">Email:</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" type="password" name="password" id="" placeholder="Password" required>
                    <label for="password">Password:</label>

                </div>

                <div class="form-check mb-3">
                    <label for="agree" class="form-check-label">
                        I agree with the <a href="">terms of services</a>
                    </label>
                    <input class="form-check-input" type="checkbox" name="agree" id="agree" value="yes" required>
                </div>
                <button class="btn btn-primary mb-3 w-100" type="submit">Login</button>
                <footer>Not a member? <a href="register.php">register here!</a></footer>



            </form>
        </section>

    </main>

</body>

</html>