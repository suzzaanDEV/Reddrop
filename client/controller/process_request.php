<?php
require "../php-config/connection.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Update info to database
    $userID = $_SESSION['userid'];
    $bloodType = trim(strtolower($_REQUEST['bloodType'])) ;
    $hospitalName = trim(strtolower($_REQUEST['hospitalName']));
    $hospitalAddress = trim(strtolower($_REQUEST['hospitalLocation']));
    $hospitalContact = trim(strtolower($_REQUEST['hospitalContact']));
    $patientName = trim(strtolower($_REQUEST['patientName']));
    $bedNumber = trim(strtolower($_REQUEST['bedNumber']));

//    echo $bedNumber.$hospitalAddress.$patientName.$userID;
    $requestSql = "INSERT INTO requests(USER_ID, BLOODTYPE, HOSPITAL_NAME, HOSPITAL_ADDRESS, HOSPITAL_CONTACT, PATIENT_NAME, BED_NUMBER) 
VALUES ('$userID', '$bloodType', '$hospitalName', '$hospitalAddress', '$hospitalContact', '$patientName', '$bedNumber');";

    $done= $conn->query($requestSql);
    if ($done){
        header("Location: ../view/Dashboard-board.php?request=1");
        exit();
    }
    header("Location: ../view/Dashboard-board.php?request=0");
    exit();
}
