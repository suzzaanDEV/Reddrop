<?php
require "../php-config/connection.php";


$records = $conn->query("SELECT * FROM donation");

$nr_of_rows = $records->num_rows;

// Setting the number of rows to display in a page.
$rows_per_page = 5;

// calculating the nr of pages.
$pages = ceil($nr_of_rows / $rows_per_page);

// Setting the start from, value.
$start = 0;


// If the user clicks on the pagination buttons.
if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}


$sql =" SELECT *
        FROM `donation` AS d  INNER JOIN `users` AS u ON d.`USER` = u.`userId` INNER JOIN donationcenter AS d2 ON d.DONATION_CENTER = d2.D_ID WHERE d.D_STATUS != 'done' LIMIT $start, $rows_per_page";

$done = $conn->query($sql);

//if ($done->num_rows >= 0){
//    while($donationData = $done->fetch_assoc()){
//
//    }
//}


