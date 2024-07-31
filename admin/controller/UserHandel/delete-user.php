<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $deleteUserId =  $_REQUEST['ID'];
    require_once "../../php-config/connection.php";
    $sql = "DELETE  FROM users WHERE userId = $deleteUserId";
    $done = $conn->query($sql);
    if ($done){
        header("Location: ../../views/usermanagement.php?delete=1");
        exit();
    }
    header("Location: ../../views/usermanagement.php?delete=0");
    exit();
}
