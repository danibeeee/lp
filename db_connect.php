<?php
$servername = "localhost"; // Server name
$username = "u600272998_learnplay"; // Database username
$password = "Learnplay123"; // Database password
$dbname = "u600272998_learnplay"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
