<?php
include 'db_connect.php'; // Include the database connection file

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the connection was established correctly
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the query to check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    if ($stmt === false) {
        die('SQL error: ' . $conn->error); // Show SQL error if query fails
    }

    // Bind the parameters to the query
    $stmt->bind_param("ss", $username, $email);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if username or email already exists
    if ($result->num_rows > 0) {
        echo "exists"; // If exists, return exists message
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('SQL error during INSERT: ' . $conn->error); // Check for error during insert
        }

        // Bind the parameters for insertion
        $stmt->bind_param("sss", $username, $email, $hashed_password);

        // Execute the insert query
        if ($stmt->execute()) {
            echo "success"; // Send success response
        } else {
            echo "error"; // Send error response
        }
    }
}
?>
