<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}

require_once("../php-config/connection.php");

// Ensure that bloodType is set and is not empty
if (isset($_GET['bloodType']) && !empty($_GET['bloodType'])) {
    $bloodType = $_GET['bloodType'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM store WHERE BLOOD_TYPE = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bloodType);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch all records for the specified blood type
    $bloodDetails = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bloodDetails[] = $row;
        }
    }
    $stmt->close();
} else {
    echo "No blood group specified.";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Group Details</title>
    <link rel="stylesheet" href="css/styles.css">
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
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h3 {
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .back-btn {
            background-color: #B91216;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .back-btn:hover {
            background-color: #a10f14;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Details for Blood Group: <?php echo htmlspecialchars($bloodType); ?></h2>
    <a href="./dashboard" class="back-btn">Back to Dashboard</a>
    <?php if (!empty($bloodDetails)): ?>
        <table>
            <thead>
                <tr>
                    <th>Track Number</th>
                    <th>Blood Group</th>
                    <th>Expiry Date</th>
                    <th>Quantity (pints)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bloodDetails as $detail): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($detail['TRACK_NUMBER']); ?></td>
                        <td><?php echo htmlspecialchars($detail['BLOOD_TYPE']); ?></td>
                        <td><?php echo htmlspecialchars($detail['BLOOD_EXPIRE_DATE']); ?></td>
                        <td><?php echo htmlspecialchars($detail['QUANTITY']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No records found for this blood group.</p>
    <?php endif; ?>

</div>

</body>
</html>
