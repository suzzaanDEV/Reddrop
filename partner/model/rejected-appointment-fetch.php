<?php

require "../php-config/connection.php";
//if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0 || isset($_COOKIE['partner_id'])) {
//
//}
$centerId = $_COOKIE['partner_id'];

$sql = "SELECT * FROM donation d
        INNER JOIN reddrop.donationcenter d2 on d.DONATION_CENTER = d2.D_ID INNER JOIN reddrop.users u on d.USER = u.userId WHERE D_ID = '13' AND D_STATUS = 'reject' OR D_STATUS = 'notAppear' ";
$done = $conn->query($sql);


