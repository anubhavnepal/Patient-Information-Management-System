<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Prepared statement for security
        $sql = $conn->prepare("DELETE FROM patients WHERE id = ?");
        $sql->bind_param("i", $id);

        if ($sql->execute()) {
            echo "Patient deleted successfully.";
        } else {
            echo "Error: " . $sql->error;
        }

        $sql->close();
    } else {
        echo "No patient ID provided.";
    }

    $conn->close();
}
