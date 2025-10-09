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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class=" bg-gray-300">
    <main class="m-auto">
        <div class="text-white bg-gray-700 font-serif text-lg px-8">
            <nav class="flex justify-between px-8 py-3">
                <div class="">
                    <a class="hover:border-b-3" href="">Home</a>
                    |
                    <a class="border-b-3" href="">Profile</a>
                </div>
                <div>
                    <h3>Hello <?= $_SESSION['username'] ?>!</h3>
                </div>
                <div>
                    <a class="hover:border-b-3" href="logout.php">Logout</a>
                </div>
            </nav>
        </div>
        <section class="flex justify-center items-center mt-9 ">
            <div class="bg-gray-700 text-white py-4 p-9 m-3 mt-9 rounded shadow-lg">
                <h2 class="text-center font-semibold text-2xl mb-3">Update your details</h2>
                <form action="">
                    <div>
                        <label class="font-bold" for="email">Email</label> <br>
                        <input class="border-1 py-1 px-2 w-100" type="email" name="email" id="email" value="<?= $_SESSION['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="font-bold" for="username">Username</label> <br>
                        <input class="border-1 py-1 px-2 w-100" type="text" name="username" id="username" value="<?= $_SESSION['username'] ?>">
                    </div>

                    <div class="flex justify-center items-center">
                        <button class="bg-gray-800 hover:bg-gray-900 hover:cursor-pointer px-4 py-2 w-50 rounded-full" type="submit">Update</button>
                    </div>
                </form>

            </div>

        </section>
    </main>
</body>

</html>