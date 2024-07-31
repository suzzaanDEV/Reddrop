<?php
require "../php-config/connection.php";

require "../php-config/connection.php";
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {

    $userId = $_SESSION['userid'];

    $sql = "SELECT * FROM `users` 
        WHERE `userId` = '$userId' ";

    $result = $conn->query($sql);
} else {
    $result = 0;
}