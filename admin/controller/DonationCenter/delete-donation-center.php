<?php
require "../../php-config/connection.php";
//Delete events
if($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_REQUEST);
    try {
        $donationCenterId = $_REQUEST['deleteId'];

        $sql = "DELETE FROM donationcenter WHERE D_ID = '$donationCenterId'";
        $done = $conn->query($sql);
        if ($done){
            header("Location: ../../views/Donation-center.php?delete=1");
            exit();
        }
        header("Location: ../../views/Donation-center.php?delete=0");
            exit();

    } catch (Exception $err){
        header("Location: ../../views/Donation-center.php?delete=0");
        exit();
    }

}