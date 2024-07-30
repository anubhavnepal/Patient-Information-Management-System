<?php
include 'db.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$condition = $_POST['condition'];
$unique_id = 'patient' . rand(1, 1000); // Generate a unique ID
$password = $_POST['password'];

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement with the new fields
$sql = "INSERT INTO patients (unique_id, password, name, age, gender, `condition`) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssss", $unique_id, $hashed_password, $name, $age, $gender, $condition);
    $stmt->execute();
    $stmt->close();
    echo "Patient added successfully.";
} else {
    echo "Error preparing statement: " . $conn->error;
}

$conn->close();
