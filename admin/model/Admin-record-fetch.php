<?php
require "../php-config/connection.php";


$sql = "SELECT BLOOD_GROUP,COUNT(DONATION_ID) FROM `donation` WHERE D_STATUS = 'done' GROUP BY `BLOOD_GROUP`;";

$resultBloodDonation = $conn->query($sql);
;

