<?php
// Replace the following variables with your actual database credentials
$host = "localhost"; // Database host (e.g., "localhost")
$username = "root"; // Database username
$password = ""; // Database password
$database = "sfund_db"; // Database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
