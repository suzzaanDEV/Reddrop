<?php
session_start();
if (!isset($_SESSION['adminId'])) {
    header("Location: ../../client/view/Home.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Records Overview Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #dashboard {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
            max-width: 800px;
        }

        h2 {
            color: #B91216;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin-top: 0;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
    </style>
</head>
<body>

<div id="dashboard">

    <h2>Blood Records Overview Dashboard</h2>

    <div class="grid-container">

        <!-- Card 1: Total Donations -->
        <div class="card">
            <h3>Total Donations</h3>
            <p>542</p>
        </div>

        <div class="card">
            <h3>O+ Donors</h3>
            <p>120</p>
        </div>

        <div class="card">
            <h3>o- Donors</h3>
            <p>45</p>
        </div>

        <div class="card">
            <h3>A- Donors</h3>
            <p>45</p>
        </div>

        <div class="card">
            <h3>A+ Donors</h3>
            <p>45</p>
        </div>

        <div class="card">
            <h3>AB+ Donors</h3>
            <p>45</p>
        </div>

        <div class="card">
            <h3>AB- Donors</h3>
            <p>45</p>
        </div>


        <!-- Add more cards for different statistics -->

    </div>


</div>

</body>
</html>
<?php
