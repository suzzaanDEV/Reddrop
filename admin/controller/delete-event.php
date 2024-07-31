<?php
require "../php-config/connection.php";
//Delete events
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $eventId = $_REQUEST['deleteEventId'];
        $deleteBannerPath = $_REQUEST['deleteEventImg'];

        $sql = "DELETE FROM events WHERE E_ID = '$eventId'";
        $done = $conn->query($sql);
        if ($done){
            if (file_exists($deleteBannerPath)){
                unlink($deleteBannerPath);
            }
            header("Location: ../views/Events.php?delete=1");
            exit();
        }
    } catch (Exception $err){

    }

}