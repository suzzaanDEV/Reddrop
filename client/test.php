<?php
//$server = "localhost";
//$username = "root";
//$password = "";
//$dbname = "reddrop";
//
//$conn = new mysqli($server, $username, $password, $dbname);
//
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

//$name ="Suzan Ghimire";
//$address ="Lalitpur, Nepal";
//$contact ="9865100888";
//$email ="suzan@admin.com";
//$password = password_hash('1234', PASSWORD_DEFAULT);
//$sql = "INSERT INTO admin(A_ID, A_NAME, A_Address, A_CONTACT, A_EMAIL, A_PASSWORD)
//VALUES(2, '$name', '$address', '$contact', '$email', '$password')";
//echo $sql;
//$conn->query($sql);


session_start();
echo $_SESSION['adminId'];
echo $_SESSION['userid'];
echo $_COOKIE['admin_id'];
echo $_COOKIE['user_id'];