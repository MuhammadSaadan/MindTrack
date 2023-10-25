<?php
include 'header-main.php'; // Include the header

// Check if the user is logged in and has a user type in the session
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];

    // Display a welcome message based on the user type
    if ($userType === 'admin') {
        $welcomeMessage = "Welcome to Admin Dashboard";
    } elseif ($userType === 'user') {
        $welcomeMessage = "Welcome to User Dashboard";
    } else {
        $welcomeMessage = "Welcome to Dashboard";
    }
} else {
    // If the user is not logged in or the user type is not set, you can handle it accordingly.
    $welcomeMessage = "Welcome to Dashboard"; // Default message for unauthenticated users
}

?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="sales">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span><?php echo $welcomeMessage; ?></span>
        </li>
    </ul>
    
    <!-- Rest of your dashboard content -->

</div>

<?php include 'footer-main.php'; // Include the footer ?>


