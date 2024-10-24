<?php
$host = "localhost";
$user = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "marco"; // Update with your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>