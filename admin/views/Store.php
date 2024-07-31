<?php
require_once("../php-config/connection.php");

// Fetch donation data from the store table
$sql = "SELECT * FROM store";
$result = $conn->query($sql);

function isExpired($expiry_date) {
    $current_date = date("Y-m-d");
    return strtotime($expiry_date) < strtotime($current_date);
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
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .search-filter {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .search-box, .filter-select {
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
        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            cursor: pointer;
            padding: 5px 10px;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="search-filter">
            <input type="text" id="searchBox" class="search-box" placeholder="Search by Track Number...">
            <select id="filterExpiration" class="filter-select">
                <option value="">All Donations</option>
                <option value="expired">Expired Donations</option>
                <option value="valid">Valid Donations</option>
            </select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Track Number</th>
                    <th>Blood Group</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Action</th> <!-- Delete column -->
                </tr>
            </thead>
            <tbody id="donationTable">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $expired = isExpired($row["BLOOD_EXPIRE_DATE"]) ? "expired" : "";
                        $status = $expired ? "Expired" : "Valid";
                        echo "<tr class='$expired'>";
                        echo "<td>" . htmlspecialchars($row["TRACK_NUMBER"]) . "</td>"; // Track Number column
                        echo "<td>" . htmlspecialchars($row["BLOOD_TYPE"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["BLOOD_EXPIRE_DATE"]) . "</td>";
                        echo "<td>" . htmlspecialchars($status) . "</td>";
                        echo "<td><form method='post' action='../controller/DonationHandel/delete_donatiopn.php' style='display:inline;'>
                                  <input type='hidden' name='track_number' value='" . htmlspecialchars($row["TRACK_NUMBER"]) . "'>
                                  <button type='submit' class='delete-btn'>Delete</button>
                              </form></td>"; // Delete button
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
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
                let trackNumber = row.cells[0].textContent.toLowerCase();
                if (trackNumber.includes(searchQuery)) {
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
