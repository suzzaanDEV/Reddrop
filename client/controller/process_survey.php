<?php
session_start();
require "../php-config/connection.php";
$userId = $_SESSION['userid'];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_REQUEST);

    // Collect form data
    $medications = $_POST['medications'];
    $health_issues = $_POST['health_issues'];
    $previous_donation_date = $_POST['previous_donation_date'];
    $weight = $_POST['weight'];
    $diseases = $_POST['diseases'] ?? [];

    $eligible = true;

    // Check for specific diseases
    $disallowed_diseases = ['Hypertension', 'Diabetes', 'Heart Disease'];
    foreach ($diseases as $disease) {
        if (in_array($disease, $disallowed_diseases)) {
            $eligible = false;
            break;
        }
    }

    // Check for specific medications
    $disallowed_medications = ['Blood Thinners', 'Steroids', 'Immunosuppressants'];
    foreach ($medications as $medication) {
        if (in_array($medication, $disallowed_medications)) {
            $eligible = false;
            break;
        }
    }

    // If eligible, change account status to eligible
    if ($eligible) {
        // Code to change account status to eligible
        $sql = "UPDATE users SET healthStatus = '1' WHERE userId = '$userId'";
        $conn->query($sql);
        header("Location: ../view/Dashboard-board.php?eligible=1");
        exit();
    } else {
        $sql = "UPDATE users SET healthStatus = '0' WHERE userId = '$userId'";
        $conn->query($sql);
        header("Location: ../view/Dashboard-board.php?eligible=0");
        exit();

    }

} else {
    header("Location: ../view/Dashboard-board.php?eligible=0");
    exit();
}
?>
