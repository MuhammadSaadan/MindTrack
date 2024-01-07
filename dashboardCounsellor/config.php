<?php

session_start(); // Start the session
include '../connect.php'; // Adjust the path based on your directory structure

if (isset($_SESSION['counselor_id'])) {
    $counsellor_id = $_SESSION['counselor_id']; // Get counsellor ID from the session
} else {
    // Redirect if the counsellor is not logged in
    header("Location: /auth/loginCounsellor.php"); // Adjust the redirection URL based on your directory structure
    exit();
}

// Add any additional configurations or functions needed for your counsellor here

?>