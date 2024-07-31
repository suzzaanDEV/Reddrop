<?php
require "../../php-config/connection.php";
session_start();
$centerId = $_SESSION['partnerId'];
$current_date = date("Y-m-d");
$expiry_date = date("Y-m-d", strtotime($current_date . " + 42 days"));

// Function to generate random 8-digit number
function generateTrackNumber() {
    return str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
}

//Delete events
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $doneId = $_REQUEST['doneId'];
        $userId = $_REQUEST['userId'];
        $bloodType = $_REQUEST['bloodGroup'];
        $donationDate = $_REQUEST['dateOfDonation'];
        $pints = $_REQUEST['pints'];
        $date = date("Y-m-d", strtotime($donationDate));
        $trackNumber = generateTrackNumber();
        echo $trackNumber;
        
        $changeSql = "UPDATE donation SET D_STATUS = 'done', TRACK_NUMBER='$trackNumber' WHERE DONATION_ID = '$doneId'";
        $done = $conn->query($changeSql);
        
        if ($done) {
            $userSql = "UPDATE users SET last_donation_date='$donationDate' WHERE userId = '$userId'";
            $conn->query($userSql);
            
            $sqlUpdateStore = "INSERT INTO store(BLOOD_TYPE, BLOOD_EXPIRE_DATE, DONATION_ID, DONATION_CENTER_ID, TRACK_NUMBER, QUANTITY)
            VALUES ('$bloodType', '$expiry_date', '$doneId', '$centerId', '$trackNumber', '$pints')";
            $conn->query($sqlUpdateStore);
            
            header("Location: ../../views/Pending-appointment.php?done=1");
            exit();
        }
    } catch (Exception $err) {
        header("Location: ../../views/Pending-appointment.php?done=0");
        exit();
    }
}

