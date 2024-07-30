<?php
include 'db.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sample data for adding a new patient
$unique_id = 'patient3';
$password = 'admin';
$name = 'Kamal Rai';
$age = 10;
$gender = 'Male';
$condition = 'Common Cold';

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement with the new fields
$sql = "INSERT INTO patients (unique_id, password, name, age, gender, `condition`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssss", $unique_id, $hashed_password, $name, $age, $gender, $condition);
    $stmt->execute();
    $stmt->close();
    echo "Patient added with hashed password.";
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
