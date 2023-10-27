<?php
$host = "localhost"; // Your MySQL server hostname
$port = 3306;
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "mindtrackdatabase"; // Your MySQL database name

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database, $port);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
} else {
    echo "Database connection successful";
}
?>