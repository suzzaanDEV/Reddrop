<?php
require "../../php-config/connection.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    print_r($_REQUEST);

    $addName = $_REQUEST['newAdminName'];
    $address = $_REQUEST['newAdminAddress'];
    $email = $_REQUEST['newAdminEmail'];
    $password = password_hash($_POST['newAdminPassword'], PASSWORD_DEFAULT);;
    $contactNumber = $_REQUEST['newAdminContactNumber'];

    echo $addName.$address.$password;
    try {
       $sql ="INSERT INTO admin(A_NAME, A_ADDRESS, A_CONTACT, A_EMAIL, A_PASSWORD) values ('$addName', '$address', '$contactNumber', '$email', '$password')";
    $registered = $conn -> query($sql);

        if($registered){
            header("Location: ../../views/AdminManagement.php?add=1");
           exit();
        }

   }catch (Exception $err){
        echo $err;
       header("Location: ../../views/AdminManagement.php?add=0");
       exit();
    }
} else {

  header("Location: ../../views/AdminManagement.php?add=0");
  exit();
}