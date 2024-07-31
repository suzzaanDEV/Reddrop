<?php
require "../../php-config/connection.php";
//Delete events
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $notAppearId = $_REQUEST['notAppearId'];
//        print_r($_REQUEST);
        $sql = "DELETE  FROM donation  WHERE DONATION_ID = '$notAppearId'";
        $done = $conn->query($sql);
        if ($done){
            header("Location: ../../views/Pending-appointment.php?delete=1");
            exit();
        }
    } catch (Exception $err){
//        echo $err;
        header("Location: ../../views/Pending-appointment.php?delete=0");
        exit();
    }

}