<?php

require "../php-config/connection.php";

$records = $conn->query("SELECT * FROM requests WHERE status = 'rejected' order by REQUEST_DATE desc ");

$nr_of_rows = $records->num_rows;

// Setting the number of rows to display in a page.
$rows_per_page = 5;

// calculating the nr of pages.
$pages = ceil($nr_of_rows / $rows_per_page);

// Setting the start from, value.
$start = 0;


// If the user clicks on the pagination buttons.
if (isset($_GET['page-nr'])) {
    $page = $_GET['page-nr'] - 1;
    $start = $page * $rows_per_page;
}

$sql = "SELECT * 
FROM requests r 
INNER JOIN users u ON r.USER_ID = u.userId 
WHERE r.status = 'rejected' 
ORDER BY REQUEST_DATE 
LIMIT $start, $rows_per_page;";

$done = $conn->query($sql);