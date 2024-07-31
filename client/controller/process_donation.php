<?php
session_start();
require "../php-config/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['date'])) {
    $userId = $_SESSION['userid'];

    $sql = "SELECT * FROM `users` 
        WHERE `userId` = '$userId' ";
    $result = $conn -> query($sql);
    $userData = $result->fetch_assoc();
    $name = $userData['name'];

    if ($userData['healthStatus'] == '1' && !isset($_REQUEST['health_conditions'])){
        $bloodGroup = trim(strtoupper($userData['bloodtype']));
        $donationCenter = trim(strtoupper($_REQUEST['donation_center']));
        $drugsTaken = trim(strtoupper($_REQUEST['drugs_taken']));
        $existingDiseases = trim(strtoupper($_REQUEST['existing_diseases']));
        $date = trim(strtoupper($_REQUEST['date']));
        $time = trim(strtoupper($_REQUEST['time']));
        $contactNumber = $userData['contactNumber'];

        $ineligibleDisesase ="HIV/AIDS
            Hepatitis B  Hepatitis C
            Creutzfeldt Jakob Disease
            Malaria";

        $ineligibleDrugs =array(
            "Aspirin (if taken in high doses)",
            "Isotretinoin", "Accutane",
            "Propecia","Finasteride",
            "Soriatane","Acitretin",
            "Tegison","Etretinate"
        );
        $key = array_search(strtolower($drugsTaken), array_map('strtolower', $ineligibleDrugs));

        if ($key !== false && strstr($ineligibleDisesase, $existingDiseases) !== false) {
            header("Location: ../view/Dashboard-board.php?booked=0");
            exit();
        }else{
                $donationCenterId = $_REQUEST['donation_center-id'];

                $bookAppointmentQuery = "INSERT INTO donation(`USER`, `DONATION_CENTER`, `BLOOD_GROUP`, `DRUG_TAKEN`, `EXISTING_DISEASE`, `CONTACT_NUMBER`, `DONATION_DATE`, `DONATION_TIME`) VALUES ('$userId', '$donationCenterId', '$bloodGroup', '$drugsTaken', '$existingDiseases', '$contactNumber', '$date', '$time')";
                $done = $conn->query($bookAppointmentQuery);
                if ($done){
                    header("Location: ../view/Dashboard-board.php?booked=1");
                    exit();
                }
        }
        header("Location: ../view/Dashboard-board.php?booked=0");
        exit();
    }else{
        header("Location: ../view/Dashboard-board.php?booked=0");
        exit();
    }

}
