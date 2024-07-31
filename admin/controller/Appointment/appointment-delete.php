<?php
require "../../php-config/connection.php";
//Delete events
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $deleteId = $_REQUEST['deleteId'];
        print_r($_REQUEST);

        $sql = "DELETE  FROM donation  WHERE DONATION_ID = '$deleteId'";
        $done = $conn->query($sql);
        if ($done){
            header("Location: ../../views/Pending-appointment.php?delete=1");
            exit();
        }
    } catch (Exception $err){
        header("Location: ../../views/Pending-appointment.php?delete=0");
        exit();
    }

}