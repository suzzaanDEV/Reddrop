<?php
require "../php-config/connection.php";
//if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {

    $centerId = $_COOKIE['partner_id'];
    $sql = "SELECT * FROM `donationcenter` WHERE D_ID = '$centerId';";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();