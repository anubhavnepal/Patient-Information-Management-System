<?php
$servername = "localhost";
$username = "root"; //database username
$password = ""; //database password
$dbname = "pims";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "succesful connection";
