
<?php
//session_start();
//if (!isset($_SESSION['clientId'])) {
//    header("Location: ../../client/view/Home.php");
//    exit();
//}
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="../public/styles/Partner-Panel.css">
    <?php require "../views/partner-Nav.php" ?>
</head>
<body>
<div class="admin-main">

<div id="sidePanel">
    <h1>Partner Panel</h1>
    <ul>
        <a href="./Pending-appointment.php" target="contentFrame"> <li><i class="fa-duotone fa-calendar-check"></i> Pending Appointments</li></a>
        <a href="./get-help.php" target="contentFrame"><li><i class="fa-duotone fa-handshake-angle"></i> Get Help</li></a>
    </ul>
</div>

<div id="content">
    <iframe name="contentFrame" src="dashboard.php"></iframe>
</div>
</div>
<?php require "../views/Footer.php"?>

</body>
</html>

