<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doneDataId =  $_REQUEST['ID'];
    require_once "../../php-config/connection.php";
    $sql = "UPDATE  requests set status='done'  WHERE R_ID = $doneDataId";
    $done = $conn->query($sql);
    if ($done){
        header("Location: ../../views/Blood-request.php?done=1");
        exit();
    }
    header("Location: ../../views/Blood-request.php?done=0");
    exit();
}

