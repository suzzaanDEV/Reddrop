<?php
require_once("../../php-config/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trackNumber = $_POST['track_number'];

    // Simple SQL query to delete a record from the store table
    $sql = "DELETE FROM store WHERE TRACK_NUMBER = '$trackNumber'";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success message
        header("Location: ../../views/Store.php?success=1");
    } else {
        // Redirect with failure message
        header("Location: ../../views/Store.php?success=0");
    }

    $conn->close();
}
?>
