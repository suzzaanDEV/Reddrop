<?php
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
    <title>Blood Request Form</title>
    <?php require "../view/LoggedNav.php";  ?>
    <link rel="stylesheet" href="../styles/Request.css">
</head>
<body>

<div class="container">


<form action="../controller/process_request.php" method="post">
    <label for="bloodType">Blood Type:</label>
    <select id="bloodType" name="bloodType" required>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
    </select>

    <label for="hospitalName">Hospital Name:</label>
    <input type="text" id="hospitalName" name="hospitalName" required>

    <label for="patientName">Patient Name:</label>
    <input type="text" id="patientName" name="patientName" required>

    <label for="bedNumber">Hospital Bed Number:</label>
    <input type="text" id="bedNumber" name="bedNumber" required>

    <label for="hospitalLocation">Hospital Address:</label>
    <input type="text" id="hospitalLocation" name="hospitalLocation" required>

    <label for="hospitalContact">Hospital Contact Number:</label>
    <input type="tel" id="hospitalContact"  pattern="[789][0-9]{9}" name="hospitalContact" required placeholder="10 digit" >
<div class="btn-container">
    <button  onclick="goBack()">Back</button>
    <button type="submit">Submit Request</button>
</div>

</form>
</div>


<?php require "../view/Footer.php"?>
<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
<?php
if (isset($_SESSION['userid']) && $_SESSION['userid'] >= 0) {
    echo "<style>.profile-img {
        display: inline-block;
    }
    .dropdown{
        display: inline-block;
    }
    .register{
        display: none;
    }<style>";
}
