<?php


require "../php-config/connection.php";

$records = $conn->query("SELECT * FROM admin");

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

$sql = "SELECT * FROM admin";
$done= $conn->query($sql);
//if ($userData->num_rows > 0){
//    while ($row=mysqli_fetch_assoc($userData)){
//        echo $row['name'];
//    }
//}
