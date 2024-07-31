<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donation data
$sql = "SELECT * FROM donation";
$result = $conn->query($sql);

function isExpired($donation_date) {
    $current_date = date("Y-m-d");
    return strtotime($donation_date) < strtotime($current_date);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Storage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #B91216;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-box, .filter-select, .add-button {
            padding: 10px;
            font-size: 16px;
        }
        .search-box {
            width: 50%;
        }
        .filter-select {
            width: 20%;
        }
        .add-button {
            background-color: #B91216;
            color: white;
            border: none;
            cursor: pointer;
            width: 20%;
        }
        .add-button:hover {
            background-color: #a10f14;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #B91216;
            color: white;
        }
        .expired {
            background-color: #ffcccc;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Blood Donation Information</h1>
    </div>

    <div class="container">
        <div class="search-filter">
            <input type="text" id="searchBox" class="search-box" placeholder="Search Blood Group...">
            <select id="filterExpiration" class="filter-select">
                <option value="">All Donations</option>
                <option value="expired">Expired Donations</option>
                <option value="valid">Valid Donations</option>
            </select>
            <button class="add-button">Add New Donation</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Donation ID</th>
                    <th>Blood Group</th>
                    <th>Donation Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="donationTable">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $expired = isExpired($row["DONATION_DATE"]) ? "expired" : "";
                        $status = $expired ? "Expired" : $row["D_STATUS"];
                        echo "<tr class='$expired'>";
                        echo "<td>" . $row["DONATION_ID"] . "</td>";
                        echo "<td>" . $row["BLOOD_GROUP"] . "</td>";
                        echo "<td>" . $row["DONATION_DATE"] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchBox').addEventListener('keyup', function() {
            let searchQuery = this.value.toLowerCase();
            let rows = document.querySelectorAll('#donationTable tr');
            rows.forEach(row => {
                let bloodGroup = row.cells[1].textContent.toLowerCase();
                if (bloodGroup.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        document.getElementById('filterExpiration').addEventListener('change', function() {
            let filterValue = this.value;
            let rows = document.querySelectorAll('#donationTable tr');
            rows.forEach(row => {
                let isExpired = row.classList.contains('expired');
                if (filterValue === 'expired' && !isExpired) {
                    row.style.display = 'none';
                } else if (filterValue === 'valid' && isExpired) {
                    row.style.display = 'none';
                } else {
                    row.style.display = '';
                }
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
