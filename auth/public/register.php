<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/../../bootstrap.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php require_once BASE_PATH . '/src/inc/bootstrap_lib.php'; ?>
</head>

<body>  
    <main class="">
        <section class="d-flex justify-content-center align-items-center mx-auto py-5 my-5 w-100">
            <form class="shadow-lg p-5 rounded" action="<?php echo BASE_URL; ?>/src/controllers/registerController.php" method="POST">
                <h1 class="h1 fw-bold text-center">Sign up</h1>
                <div class="form-floating">
                    <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                    <label class="" for="username">Username</label>
                   
                </div>

                <div class="form-floating">
                    <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                    <label for="email">Email:</label>
                </div>

                <div class="form-floating">
                    <input class="form-control" type="password" name="password" id="" placeholder="Password">
                    <label for="password">Password:</label>
                    
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="password2" id="" placeholder="Password Again">
                    <label for="password2">Password Again:</label>
                    
                </div>

                <div class="form-check mb-3">
                    <label for="agree" class="form-check-label">
                        I agree with the <a href="">terms of services</a>
                    </label>
                    <input class="form-check-input" type="checkbox" name="agree" id="agree" value="yes">
                </div>
                <button class="btn btn-primary mb-3 w-100" type="submit">Register</button>
                <footer>Already a member? <a href="login.php">login here!</a></footer>



            </form>
        </section>
        
    </main>

</body>

</html>