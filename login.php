<?php
session_start();
include 'db.php';

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $unique_id = $_POST['unique_id'];
    $password = $_POST['password'];

    // Prepare and execute query
    if ($stmt = $conn->prepare("SELECT * FROM patients WHERE unique_id = ?")) {
        $stmt->bind_param("s", $unique_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['patient_id'] = $row['id'];
                header('Location: dashboard.php');
                exit(); // Important to prevent further code execution
            } else {
                echo "Invalid password";
            }
        } else {
            echo "No patient found with this ID";
        }

        $stmt->close();
    } else {
        // Output error if the prepare statement fails
        echo "Error preparing statement: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patient Login</title>
    <link rel="stylesheet" href="styles.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="script.js" defer></script>
  </head>
  <body class="bg-[#DDDDDD]">
    <section class="login-container m-auto mt-24 flex justify-center w-full">
      <div class="signin_container bg-white w-1/3 py-16 rounded-l-lg">
        <h1 class="text-center text-3xl ">Patient Login</h1>
        <form
          id="loginForm"
          class="py-10 px-10 space-y-5"
          action="login.php"
          method="post"
        >
          <input
            placeholder="Unique ID"
            type="text"
            class="border focus:border-indigo-300 focus:outline-none focus:shadow-md focus:shadow-indigo-200 p-[.8rem] bg-[#EFEFEF] rounded-lg w-full mb-4"
            id="unique_id"
            name="unique_id"
            required
          />
          <input
            placeholder="Password"
            type="password"
            id="password"
            class="border focus:border-indigo-300 focus:outline-none focus:shadow-md focus:shadow-indigo-200 p-[.8rem] bg-[#EFEFEF] rounded-lg w-full mb-4"
            name="password"
            required
          />
          <button
            type="submit"
            class="bg-slate-800 p-[.8rem] rounded-xl text-white w-full border hover:bg-slate-900"
          >
            LOGIN
          </button>
        </form>
      </div>
      <div
        class="welcome_msg_container w-1/3 bg-gradient-to-br from-[#2CC991] to-[#059669] px-10 pt-24 text-center text-white rounded-r-lg"
      >
        <h1 class="welcome_title text-3xl text-white font-semibold">
          Welcome back!
        </h1>
        <p class="mt-6">
          We're dedicated to ensuring your healthcare information is managed
          securely and effectively. Access your medical records, schedule
          appointments, and communicate with your healthcare providers
          seamlessly.
        </p>
        <p
          class="mt-10 bg-gradient-to-br from-[#10B981] inline-block p-4 rounded-xl hover:cursor-pointer shadow-md hover:shadow-lg hover:text-slate-100"
        >
          No account yet? Sign Up
        </p>
      </div>
    </section>
  </body>
</html>
