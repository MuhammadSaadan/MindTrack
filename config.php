<?php

session_start(); // Start the session
include '../connect.php';



if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get user ID from the session
} else {

    // Redirect if the user is not logged in
    header("Location: /auth/login.php");
    exit();
}

?>