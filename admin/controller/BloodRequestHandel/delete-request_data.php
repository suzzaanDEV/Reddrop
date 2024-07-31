<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $deleteDataId =  $_REQUEST['ID'];
    require_once "../../php-config/connection.php";
    $sql = "UPDATE  requests set status='rejected'  WHERE R_ID = $deleteDataId";
    $done = $conn->query($sql);
    if ($done){
        header("Location: ../../views/Blood-request.php?delete=1");
        exit();
    }
    header("Location: ../../views/Blood-request.php?delete=0");
    exit();
}


