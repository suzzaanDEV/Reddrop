<?php
require "../php-config/connection.php";
//if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {

$sql = "SELECT * FROM `donationcenter`;";

$result = $conn->query($sql);
//$row = $result->fetch_assoc();
