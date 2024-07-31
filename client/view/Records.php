<?php
 require "../php-config/connection.php";
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['next'])){
        echo "HELLO";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation History</title>
    <link rel="stylesheet" href="../styles/Records.css">
    <?php require "../view/LoggedNav.php"; ?>
</head>
<body>
<div class="container">

<h1>Blood Donation History</h1>

<div id="filters">
    <input type="text" id="search" oninput="filterTable()" placeholder="Search by Name">
    <select id="year" onchange="filterTable()">
        <option value="all">All</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
        <option value="2022">2022</option>
    </select>
    <button onclick="printTable()">Print</button>
</div>

<table id="donationTable">
    <thead>
    <tr>
        <th>Donation Center Name</th>
        <th>Blood Type</th>
        <th>Donation Date</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody>
        <?php
       

        $userId = $_SESSION['userid'];
    $sql = "SELECT * FROM donation d INNER JOIN users u ON d.USER = u.userId INNER JOIN donationcenter dc ON d.DONATION_CENTER = dc.D_ID WHERE u.userId = '$userId'  ";
        $done = $conn->query($sql);
       
         
         if ($done) {
            while( $donationData = $done->fetch_assoc()){
   ?>
        <tr>
        <td><?php echo $donationData['name']; ?></td>
        <td><?php echo $donationData['BLOOD_GROUP']; ?></td>
        <td><?php echo $donationData['DONATION_DATE']; ?></td>
        <td><?php echo $donationData['D_ADDRESS']; ?></td>
    </tr>
   <?php
            }
        }?> 
    </tbody>

</table>
    <button type="button" onclick="history.back()">Back</button>

    </div>

<?php require "../view/Footer.php"?>
<script>
    function filterTable() {
        let input, year, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        year = document.getElementById("year").value;
        filter = input.value.toUpperCase();
        table = document.getElementById("donationTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that don't match the search query and year
        let yearColumn;
        let yearValue;

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Assume the name is in the first column
            yearColumn = tr[i].getElementsByTagName("td")[2]; // Assume the year is in the third column
            if (td && yearColumn) {
                txtValue = td.textContent || td.innerText;
                yearValue = yearColumn.textContent || yearColumn.innerText;
                // console.log(yearValue.includes(year));
                if ((txtValue.toUpperCase().indexOf(filter) > -1 || filter === "") &&
                    (year === "all" || yearValue.includes(year))) {
                    tr[i].style.display = "";
                    // console.log('hello');
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }



    function printTable() {
        let printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Blood Donation History</title><?php require "../controller/dashboard-fetch.php";?></head><body>');
        printWindow.document.write('<h1>RedDrop</h1>'); // Logo and website name
        printWindow.document.write(`<p><strong>Name:<?php
        if ($result) {
            $row = $result->fetch_assoc();
            echo "<p id='admin-name'>" . $row['name'] . "</p>";
        }
        ?></p>`);
        //printWindow.document.write(`<p><strong>Address:<?php
        //if ($result) {
        //    $row = $result->fetch_assoc();
        //    echo "<p id='admin-name'>" . $row['address'] . "</p>";
        //}
        //?>//</p>`);
        //printWindow.document.write(`<p><strong>Contact Number:<?php
        //if ($result) {
        //    $row = $result->fetch_assoc();
        //    echo "<p id='admin-name'>" . $row['contactNumber'] . "</p>";
        //}
        //?>//</p>`);
        //printWindow.document.write(`<p><strong>Blood Group:<?php
        //if ($result) {
        //    $row = $result->fetch_assoc();
        //    echo "<p id='admin-name'>" . $row['bloodtype'] . "</p>";
        //}
        //?>//</p>`);
        printWindow.document.write('<h1>Blood Donation History</h1>');
        printWindow.document.write(document.getElementById("donationTable").outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
        window.location.replace("");
    }
    // function printTable() {
    //     var printWindow = window.open('', '_blank');
    //     printWindow.document.write('<html><head><title>Blood Donation History</title></head><body>');
    //     printWindow.document.write('<h1>Blood Donation History</h1>');
    //     printWindow.document.write(document.getElementById("donationTable").outerHTML);
    //     printWindow.document.write('</body></html>');
    //     printWindow.document.close();
    //     printWindow.print();
    // }


</script>

</body>
</html>
<?php
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {
    echo "<style> 
.profile-img {
        display: inline-block;
    }
    .dropdown{
        display: inline-block;
    }
    .register{
        display: none;
    }<style>";
}
?>
