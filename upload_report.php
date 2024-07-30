<?php
// upload_report.php
session_start();
include 'db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['patient_id'])) {
    echo json_encode(['message' => 'Unauthorized']);
    exit();
}

$patient_id = $_SESSION['patient_id'];
$report = $_POST['report'];

$sql = "INSERT INTO reports (patient_id, report) VALUES ('$patient_id', '$report')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'New report uploaded successfully']);
} else {
    echo json_encode(['message' => 'Error: ' . $conn->error]);
}
?>
