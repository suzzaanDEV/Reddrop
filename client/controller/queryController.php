<?php
include '../php-config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Qname'];
    $email = $_POST['Qemail'];
    $subject = $_POST['subject'];
    $message = $_POST['Query'];

    $stmt = $conn->prepare("INSERT INTO queries (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Query submitted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit query']);
    }

    $stmt->close();
}
$conn->close();
?>
