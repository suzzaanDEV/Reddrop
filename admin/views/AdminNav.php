<?php
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System</title>
    <link rel="stylesheet" href="../Public/styles/AdminNav.css">
</head>

<body>

    <div id="navbar">
        <div id="navbarIcon"><a href="#" id="logo"><img src="../Public/Images/logo.webp" alt="" width="150"></a>
        <span onclick="displaySideBar()"><i class="fa-duotone fa-solid fa-bars" ></i></span>
            
        </div>

        <div id="profile">
            <?php
            require "../model/Admin-admin-fetch.php";
            ?>
            <img src="../Public/Images/Profile.png" alt="Profile Photo" id="profilePhoto">
            <span><?php echo $row['A_NAME'] ?></span>
            <a href="../../client/controller/logout.php">
                <button id="logout">Logout</button>
            </a>
        </div>

    </div>
    <script>
        
    </script>

</body>

</html>