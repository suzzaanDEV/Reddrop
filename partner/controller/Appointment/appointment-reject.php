<?php
require "../../php-config/connection.php";
//Delete events
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $deleteId = $_REQUEST['rejectId'];
        $userId = $_REQUEST['userId'];
        print_r($_REQUEST);
        $sql = "DELETE  FROM donation  WHERE DONATION_ID = '$deleteId'";
        $done = $conn->query($sql);
        if ($done){
            $changeSql = "UPDATE users SET healthStatus = null WHERE userId = '$userId'";
            $conn->query($changeSql);
            header("Location: ../../views/Pending-appointment.php?delete=1");
            exit();
        }
    } catch (Exception $err){
//        echo $err;
        header("Location: ../../views/Pending-appointment.php?delete=0");
        exit();
    }

}