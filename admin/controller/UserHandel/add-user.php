<?php
require "../../php-config/connection.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $addName = $_REQUEST['newUserName'];
    $bloodType = $_REQUEST['newBloodType'];
    $address = $_REQUEST['newUserAddress'];
    $email = $_REQUEST['newUserEmail'];
    $password = password_hash($_POST['newUserPassword'], PASSWORD_DEFAULT);;
    $contactNumber = $_REQUEST['newUserContactNumber'];
    $lastDonationDate = $_REQUEST['newUserLastDonationDate'];
    $date = date("Y-m-d", strtotime($lastDonationDate));

    echo $addName.$address.$password;
    try {
        $sql = "INSERT INTO users ( `name`, `email`, `password`, `contactNumber`, `bloodType`, `address`, `last_donation_date`)
            VALUES ('$addName', '$email', '$password','$contactNumber', '$bloodType', '$address', '$date')";

        $registered = $conn -> query($sql);

        if($registered){
            header("Location: ../../views/usermanagement.php?add=1");
            exit();
        }

    }catch (Exception $err){
        echo $err;
//        header("Location: ../../views/usermanagement.php?add=0");
//        exit();
    }
} else {

    header("Location: ../../views/usermanagement.php?add=0");
    exit();
}