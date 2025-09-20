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
    <main class="container">
        <form action="POST">
            <div>Sign up</div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="" id="">
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="" id="">
            </div>

            <div>
                <label for="password2">Password Again:</label>
                <input type="password" name="" id="">
            </div>

            <div>
                <label for="agree">
                    <input type="checkbox" name="agree" id="agree" value="yes"> I agree with the <a href="">terms of services</a>
                </label>
            </div>
            <button type="submit">Register</button>
            <footer>Already a member? <a href="login.php">login here!</a></footer>



        </form>
    </main>

</body>

</html>