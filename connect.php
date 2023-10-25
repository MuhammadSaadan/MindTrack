<?php
$host = "localhost"; // Your MySQL server hostname
$username = "your_username"; // Your MySQL username
$password = "your_password"; // Your MySQL password
$database = "your_database"; // Your MySQL database name

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // You are now connected to the database. You can perform database operations here.

    // Don't forget to close the connection when you're done.
    $pdo = null;
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>