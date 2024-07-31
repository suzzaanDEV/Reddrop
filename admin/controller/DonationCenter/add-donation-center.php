<?php
require "../../php-config/connection.php";
echo "hello";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "hello";
    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];
    $location = $_REQUEST['googleMapLink'];
    $contact = $_REQUEST['contact'];
    $email = $_REQUEST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);;
    try {
        $sql = "INSERT INTO donationcenter(D_NAME, D_ADDRESS, D_LOCATION, D_CONTACT, D_EMAIL, D_PASS) VALUES ('$name', '$address', '$location', '$contact','$email', '$password')";
        $done = $conn->query($sql);
        if ($done){
        header("Location: ../../views/Donation-center.php?done=1");
        exit();
        }

    }catch (Exception $e){
        echo $e;
    }

    header("Location: ../../views/Donation-center.php?done=0");
    exit();
}

