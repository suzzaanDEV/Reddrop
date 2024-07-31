
<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Home.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compatibility Table</title>
    <link rel="stylesheet" href="../styles/Compatibality.css">
    <?php require "../view/LoggedNav.php"; ?>
</head>

<body>
<div class="container">


<table>
    <thead>
    <tr>
        <th>Blood Type</th>
        <th>Can Donate To</th>
        <th>Can Receive From</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="donor-type">A+</td>
        <td>A+, AB+</td>
        <td>A+, A-, O+, O-</td>
    </tr>
    <tr>
        <td class="donor-type">A-</td>
        <td>A+, A-, AB+, AB-</td>
        <td>A-, O-</td>
    </tr>
    <tr>
        <td class="donor-type">B+</td>
        <td>B+, AB+</td>
        <td>B+, B-, O+, O-</td>
    </tr>
    <tr>
        <td class="donor-type">B-</td>
        <td>B+, B-, AB+, AB-</td>
        <td>B-, O-</td>
    </tr>
    <tr>
        <td class="donor-type">AB+</td>
        <td>AB+</td>
        <td>Everyone</td>
    </tr>
    <tr>
        <td class="donor-type">AB-</td>
        <td>AB+, AB-</td>
        <td>A-, B-, AB-, O-</td>
    </tr>
    <tr>
        <td class="donor-type">O+</td>
        <td>A+, B+, AB+, O+</td>
        <td>O+, O-</td>
    </tr>
    <tr>
        <td class="donor-type">O-</td>
        <td>Everyone</td>
        <td>O-</td>
    </tr>

    </tbody>

</table>
    <button class="button-main" onclick="history.back()">Back</button>
    <?php require "../view/Footer.php" ?>

</div>


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
?>
