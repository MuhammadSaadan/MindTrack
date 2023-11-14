<?php

require '../config.php';
include '../header-main.php';



if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
    $userName = 'User'; // Default name

    $userId = $_SESSION['user_id'];
    $query = "SELECT name FROM users WHERE id = $userId";

    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (isset($row['name'])) {
                $userName = $row['name'];
            }
        }
    }
}

// Fetch mood data from the database
$moodQuery = "SELECT mood, COUNT(*) as count FROM log_mood WHERE user_id = $userId GROUP BY mood";
$moodResult = $conn->query($moodQuery);

// Fetch symptom data from the database
$symptomQuery = "SELECT symptom, COUNT(*) as count FROM log_symptoms WHERE user_id = $userId GROUP BY symptom";
$symptomResult = $conn->query($symptomQuery);
?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Dashboard</a>
    </li>

</ol>
<br>

<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Hello,
            <?php echo $userName; ?>
        </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Welcome To Mindtrack!</p>
        <p class="lead">
            <button type="button" x-on:click="window.location.href='/mhealthInformation/info.php'"
                class="btn btn-dark">Learn more...</button>
        </p>
    </div>

    <br>


    <?php include '../footer-main.php'; ?>