<?php
require "../php-config/connection.php";

$records = "SELECT * FROM events";
$run = $conn->query($records);

$nr_of_rows = $run->num_rows;

// Setting the number of rows to display in a page.
$rows_per_page = 4;

// calculating the nr of pages.
$pages = ceil($nr_of_rows / $rows_per_page);

// Setting the start from, value.
$start = 0;


// If the user clicks on the pagination buttons.
if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}


$sql = "SELECT * FROM events order by events.E_DATE desc LIMIT $start, $rows_per_page";
$done = $conn->query($sql);


