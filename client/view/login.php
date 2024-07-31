<?php require "../view/Navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login.css">
    <script>
        document.getElementById("wrong-pass").removeAttribute("hidden");
        document.getElementById('successfully-register').removeAttribute("hidden")
    </script>

</head>

<body>  
    <div class="login-container">
        <div class="logo-login">
            <img src="../assets/logo.webp" alt="logo" width="100">
        </div>
        <h2>Login</h2>
        <p class="wrong-pass" id="wrong-pass" hidden>wrong password, Try again.</p>
        <p class="successfully-register" id="successfully-register" hidden>Successfully register, Please login.</p>
        <p class="unable-login" id="user-not-found" hidden>User not found please  <a href="register.php">create an account</a></p>
        <form action="../controller/process_login.php" method="post">
            <label for="username">Email:</label>
            <input type="text" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="checkbox" id="save" name="save" value="1" checked>
            <label for="save">Save login</label>

            <input type="submit" value="Login">
            <a href="register.php" class="create-acc">create an account</a>
        </form>
    </div>
    <?php require("./Footer.php")?>
    <?php
    if (isset($_GET["error"]) && $_GET["error"] == 1) {
        echo "<script>
        document.getElementById('wrong-pass').removeAttribute('hidden');
    </script>";
    }
    if (isset($_GET["done"]) && $_GET["done"] == 1) {
        echo "<script>
        document.getElementById('successfully-register').removeAttribute('hidden')
    </script>";
    }
    if (isset($_GET["notfound"]) && $_GET["notfound"] == 1) {
        echo "<script>
        document.getElementById('admin-not-found').removeAttribute('hidden');
    </script>";
    } else{
        echo "<script>
        document.getElementById('admin-not-found').setAttribute('hidden' , '');
    </script>";
    }
    ?>
    

</body>


</html>