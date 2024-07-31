<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateUserId = $_REQUEST['userId'];
    print_r($_REQUEST);
    echo $updateUserId;

    $updatedName = $_REQUEST['updatedName'];
    $newBloodType = $_REQUEST['newBloodType'];
    $editUserAddress = $_REQUEST['editUserAddress'];
    $editUserEmail = $_REQUEST['editUserEmail'];
    $editUserPassword = $_REQUEST['editUserPassword'];
    $editUserContactNumber = $_REQUEST['editUserContactNumber'];
    $updatedLastDonationDate = $_REQUEST['updatedLastDonationDate'];

    require_once "../../php-config/connection.php";
    $sql = "UPDATE users SET name='$updatedName', bloodtype = '$newBloodType', address = '$editUserAddress', email= '$editUserEmail', contactNumber = '$editUserContactNumber', last_donation_date = '$updatedLastDonationDate'  WHERE userId = '$updateUserId'";
    $done = $conn->query($sql);
    if ($done) {
        if ($_REQUEST['editUserPassword'] != ""){
            $password = password_hash($_POST['editUserPassword'], PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$password' WHERE userId = '$updateUserId'";
            $done = $conn->query($sql);
            if (!$done){
                header("Location: ../../views/usermanagement.php?update=0");
                exit();
            }
        }
        header("Location: ../../views/usermanagement.php?update=1");
        exit();
    }
    header("Location: ../../views/usermanagement.php?update=0");
    exit();
}
