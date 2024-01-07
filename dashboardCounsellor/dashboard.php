<?php
// Check if the counselor is logged in and has a counselor_id in the session
session_start();
include 'header-main.php'; // Include the header

if (isset($_SESSION['counselor_id'])) {
    $counselorId = $_SESSION['counselor_id'];

    $welcomeMessage = "Welcome to Counsellor Dashboard"; 
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

<?php include '../footer-main.php'; // Include the footer ?>
