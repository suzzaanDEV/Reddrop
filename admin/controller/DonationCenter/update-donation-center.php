<?php
require "../../php-config/connection.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim(strtoupper($_REQUEST['editName']));
    $address = trim(strtoupper($_REQUEST['editAddress']));
    $location = trim($_REQUEST['editGoogleMapLink']);
    $contact = $_REQUEST['editContact'];
    $email = trim(strtolower($_REQUEST['editEmail']));
    $updateId = $_REQUEST['updateId'];

    print_r($_REQUEST);

////    $sql = "INSERT INTO donationcenter(D_NAME, D_ADDRESS, D_LOCATION, D_CONTACT) VALUES ('$name', '$address', '$location', '$contact')";
////    $done = $conn->query($sql);
//    header("Location: ../../views/Donation-center.php?done=0");
//    exit();

    $sql = "UPDATE donationcenter SET D_NAME='$name', D_ADDRESS = '$address',D_LOCATION= '$location', D_CONTACT = '$contact', D_EMAIL ='$email' WHERE D_ID = '$updateId'";
    $done = $conn->query($sql);
    if ($done) {
        if ($_REQUEST['editAdminPassword'] != ""){
            $password = password_hash($_POST['editPass'], PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET A_PASSWORD = '$password' WHERE D_ID = '$updateId'";
            $done = $conn->query($sql);
            if (!$done){
                echo "Password updated successfully";
                header("Location: ../../views/Donation-center.php?update=0");
                exit();
            }
        }
        header("Location: ../../views/Donation-center.php?update=1");
        exit();
    }
    header("Location: ../../views/Donation-center.php?update=0");
    exit();
}

