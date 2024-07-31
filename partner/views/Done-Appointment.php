<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Appointments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/styles/pending-appointment.css">
</head>
<body>

<div class="container">
    <button class="button-main" onclick="history.back()">Back</button>
    <h1>Done Appointments</h1>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by Name or Location" onkeyup="searchTable()">
    </div>

    <table id="appointmentTable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Location</th>
            <th>Blood Group</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <!-- Sample Data -->
        <?php
        require "../model/done-appoitment-fetch.php";
        if ($done->num_rows > 0){
            while ($row = $done->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['DONATION_DATE']?></td>
                    <td><?php echo $row['DONATION_TIME']?></td>
                    <td><?php echo $row['D_NAME']?></td>
                    <td><?php echo $row['BLOOD_GROUP']?></td>
                    <td class="action-btns">
                        <button class="done-btn">Done</button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        <!-- Add more sample data as needed -->
        </tbody>
    </table>
</div>

<script>
    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("appointmentTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
</script>

</body>
</html>
