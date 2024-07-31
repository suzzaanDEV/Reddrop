<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_REQUEST);
    $updateAdminId = $_REQUEST['adminId'];

    $updatedName = $_REQUEST['updatedName'];
    $editAddress = $_REQUEST['editAdminAddress'];
    $editEmail = $_REQUEST['editAdminEmail'];
    $editPassword = $_REQUEST['editAdminPassword'];
    $editContactNumber = $_REQUEST['editAdminContactNumber'];

    require_once "../../php-config/connection.php";
    $sql = "UPDATE admin SET A_NAME='$updatedName', A_ADDRESS = '$editAddress', A_EMAIL= '$editEmail', A_CONTACT = '$editContactNumber' WHERE A_ID = '$updateAdminId'";
    $done = $conn->query($sql);
    if ($done) {
        if ($_REQUEST['editAdminPassword'] != ""){
            $password = password_hash($_POST['editAdminPassword'], PASSWORD_DEFAULT);
            $sql = "UPDATE admin SET A_PASSWORD = '$password' WHERE A_ID = '$updateAdminId'";
            $done = $conn->query($sql);
            if (!$done){
                echo "Password updated successfully";
                header("Location: ../../views/AdminManagement.php?edit=0");
                exit();
            }
        }
        header("Location: ../../views/AdminManagement.php?edit=1");
        exit();
    }
    header("Location: ../../views/AdminManagement.php?edit=0");
    exit();
}
