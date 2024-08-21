<?php
session_start();
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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
    <link rel="stylesheet" href="../Public/styles/Admin-Panel.css">
    <?php require "../views/AdminNav.php"?>
</head>
<body>
<div class="admin-main">

<div id="sidePanel">
    <h1>Admin Panel</h1>
    <i class="fa-duotone fa-solid fa-xmark" onclick="hideSideBar()" hidden></i>
    <ul>
        <a href="./Dashboard" target="contentFrame"><li><i class="fa-duotone fa-gauge"></i> Dashboard</li></a>
        <a href="./Store.php" target="contentFrame"><li><i class="fa-duotone fa-store"></i> Store</li></a>
        <a href="./Blood-request.php" target="contentFrame"><li><i class="fa-duotone fa-truck-droplet"></i> Bloods Request</li></a>
        <a href="./usermanagement.php" target="contentFrame"> <li><i class="fa-duotone fa-user"></i> User Management</li></a>
        <a href="./AdminManagement.php" target="contentFrame"> <li><i class="fa-duotone fa-user-tie"></i> Admin Management</li></a>
        <a href="./Pending-appointment.php" target="contentFrame"> <li><i class="fa-duotone fa-calendar-check"></i> Pending Appointments</li></a>
        <a href="./Events.php" target="contentFrame"><li><i class="fa-duotone fa-calendar-days"></i> Events Management</li></a>
        <a href="./Donation-center.php" target="contentFrame"><li><i class="fa-duotone fa-hospitals"></i> Donation Center</li></a>
        <a href="./Inbox.php" target="contentFrame"><li><i class="fa-duotone fa-inbox"></i>Inbox</li></a>
    </ul>
</div>

<div id="content">
    <iframe name="contentFrame" src="./Dashboard"></iframe>
</div>
</div>
<?php require "../views/Footer.php"?>

<script>
    const hideSideBar = ()=>{
        document.getElementById("sidePanel").style.display = 'none';
    }

    const displaySideBar = ()=>{
        console.log('clicked');
        document.getElementById("sidePanel").style.display = 'block';
    }
</script>

</body>
</html>
