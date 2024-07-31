<?php
//if (!isset($_SESSION['clientId'])) {
//    header("Location: ../../client/view/Home.php");
//    exit();
//}

require "../model/center-data-fetch.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System</title>
    <link rel="stylesheet" href="../public/styles/Partner-Nav.css">
</head>
<body>

<div id="navbar">
    <a href="#" id="logo"><img src="../public/Images/logo.webp" alt="" width="150"></a>

    <div id="profile">
        <img src="../public/Images/Profile.png" alt="Profile Photo" id="profilePhoto">
        <span><?php echo $row['D_NAME']?></span>
        <a href="../../client/controller/logout.php">
            <button id="logout">Logout</button>
        </a>
    </div>

</div>

</body>
</html>

