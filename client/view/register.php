<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../styles/register.css">
    <script>
        
    </script>
</head>

<body>
    <div class="container">
        <div class="registration-form">

            <form action="../controller/process_registration.php" method="post">
                <div class="logo-login">
                    <img src="../assets/logo.webp" alt="logo" width="100">
                </div>
                <h2>User Registration</h2>
            <p class="failed" id="failed" >Failed to register, Try again.</p>

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <label for="address">Address</label>
                <input type="text" id="address" name="address"  required><br>

                <label for="phone">Contact Number:</label>
                <input type="text" id="phone" name="phone" required><br>

                <label for="bloodType">Blood Type:</label>
                <select id="bloodType" name="bloodType" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>

                <label for="donorStatus">Do you want to donate?</label>
                <select name="donorStatus" id="donorStatus" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>


                <div class="btn-container">
                    <input type="submit" value="Register">
                    <a href="login.php">
                        <input type="button" value="Already have an account">
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>

<?php
    if (isset($_GET["unable"]) && ($_GET["unable"] == 1)) {
        echo "<script>
        document.getElementById('failed').removeAttribute('hidden');
    </script>";
    }
    if (isset($_GET["failed"]) && ($_GET["failed"] == 1)) {
        echo "<script>
        document.getElementById('failed').removeAttribute('hidden');
    </script>";
    }else{
        echo "<script>
        document.getElementById('failed').setAttribute('hidden','');
    </script>";
    }
?>