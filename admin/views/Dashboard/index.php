<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}

require_once("../../php-config/connection.php");

// Fetch blood group quantities from the database
$sql = "SELECT BLOOD_TYPE, SUM(QUANTITY) AS TOTAL_QUANTITY
        FROM store
        GROUP BY BLOOD_TYPE";
$result = $conn->query($sql);

$bloodQuantities = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $bloodQuantities[$row['BLOOD_TYPE']] = $row['TOTAL_QUANTITY'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Records Overview Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        #dashboard {
            width: 90%;
            margin: 20px auto;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .card h3 {
            margin: 0 0 10px 0;
        }
        .chart-container {
            margin-bottom: 20px;
        }
        .view-btn {
            background-color: #B91216;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .view-btn:hover {
            background-color: #a10f14;
        }
    </style>
</head>
<body>

<div id="dashboard">

    <h2>Blood Records Overview Dashboard</h2>

    <div>
        <label for="dateFilter">Filter by Date:</label>
        <input type="date" id="dateFilter">
    </div>
    <br>

    <div class="grid-container">
        <!-- Existing cards -->
        <div class="card">
            <h3>Total Donations</h3>
            <p id="totalDonations">542</p>
        </div>

        <div class="card">
            <h3>O+ Donors</h3>
            <p id="oPlusDonors">120</p>
        </div>

        <div class="card">
            <h3>O- Donors</h3>
            <p id="oMinusDonors">45</p>
        </div>

        <div class="card">
            <h3>A- Donors</h3>
            <p id="aMinusDonors">45</p>
        </div>

        <div class="card">
            <h3>A+ Donors</h3>
            <p id="aPlusDonors">45</p>
        </div>

        <div class="card">
            <h3>AB+ Donors</h3>
            <p id="abPlusDonors">45</p>
        </div>

        <div class="card">
            <h3>AB- Donors</h3>
            <p id="abMinusDonors">45</p>
        </div>

        <!-- New cards for blood quantity -->
        <?php foreach ($bloodQuantities as $bloodType => $quantity): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($bloodType); ?> Blood</h3>
            <p><?php echo htmlspecialchars($quantity); ?> pints</p>
            <a href="../blood_details.php?bloodType=<?php echo urlencode($bloodType); ?>" class="view-btn">View Details</a>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="chart-container">
        <canvas id="bloodGroupChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="donationTrendsChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="donationByCenterChart"></canvas>
    </div>

</div>

<script src="js/script.js"></script>
</body>
</html>
