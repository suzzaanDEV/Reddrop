<?php
require "../php-config/connection.php";
$adminId = $_SESSION['adminId'];
$sql = "SELECT * FROM admin WHERE A_ID = '$adminId'";
 $done= $conn->query($sql);
 $row= $done->fetch_assoc();
