<?php
require "../php-config/connection.php";

    $userId = $_SESSION['userid'];
$sql = "SELECT * FROM donation d INNER JOIN users u ON d.USER = u.userId WHERE  u.userId = '$userId'  ";
    $done = $conn->query($sql);
   