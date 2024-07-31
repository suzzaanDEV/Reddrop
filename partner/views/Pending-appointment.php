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
    <h1>Pending Appointments</h1>

    <div class="btn-top">
        <a href="Done-Appointment.php"><button class="done-btn">Done Donation</button></a>
        <a href="Rejected-Appointment.php"><button class="delete-btn">Rejected Request</button></a>
    </div>

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
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <!-- Sample Data -->
        <?php
            require "../model/Pending-appointment-fetch.php";
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
                            <form action="../controller/Appointment/appointment-done.php" method="post">
                                <input type="hidden" name="userId" value="<?php echo $row['userId']?>">
                                <input type="hidden" name="bloodGroup" value="<?php echo $row['BLOOD_GROUP']?>">
                                <input type="hidden" name="doneId" value="<?php echo $row['DONATION_ID']?>">
                                <input type="hidden" name="dateOfDonation" id="dateOfDonation" value="<?php echo $row['DONATION_DATE']?>">
                                <button class="done-btn">Done</button>
                            </form>
                            <form action="../controller/Appointment/appointment-reject.php" method="post">
                                <input type="hidden" name="rejectId" value="<?php echo $row['DONATION_ID']?>">
                                <input type="hidden" name="userId" value="<?php echo $row['userId']?>">
                                <button class="delete-btn" value="reject">Reject</button>
                            </form>
                            <form action="../controller/Appointment/appointment-notAppear.php" method="post">
                                <input type="hidden" name="notAppearId" value="<?php echo $row['DONATION_ID']?>">
                                <button class="delete-btn" value="notAppear">Not appear</button>
                            </form>
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
