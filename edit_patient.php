<?php
include 'db.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve form data
$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$condition = $_POST['condition'];

// Prepare the SQL statement for updating the patient
$sql = "UPDATE patients SET name = ?, age = ?, gender = ?, `condition` = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sissi", $name, $age, $gender, $condition, $id);
    $stmt->execute();
    $stmt->close();
    echo "Patient updated successfully.";
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
