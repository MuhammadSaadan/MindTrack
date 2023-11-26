<?php
require '../config.php';
include '../header-main.php';

$successMessage = ''; // Initialize the success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id']; // Assuming you store user ID in the session
    $mood = $_POST['mood']; // Assuming the mood is received from the form input
    $description = $_POST['description']; // Additional description field from the form
    $rating = $_POST['rating']; // Additional rating field from the form

    // Perform some basic validation
    if (empty($user_id) || empty($mood) || empty($description) || empty($rating)) {
        echo "All fields are required."; // Handle any errors
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "INSERT INTO log_mood (user_id, mood, description, rating) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("isss", $user_id, $mood, $description, $rating);
            if ($stmt->execute()) {
                // Notification handling with SweetAlert2 in green color directly in JavaScript
                echo "<script defer src='/assets/js/apexcharts.js'></script>";
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                        coloredToast = () => {
                            const toast = window.Swal.mixin({
                                toast: true,
                                position: 'bottom-start',
                                showConfirmButton: false,
                                timer: 3000,
                                showCloseButton: true,
                                customClass: {
                                    popup: 'background-color: #5cb85c; color: white; border-radius: 5px;' // Inline styles for green color
                                }
                            });
                            toast.fire({
                                title: 'Mood Logged Successfully',
                                icon: 'success'
                            });
                        };
                        coloredToast();
                    </script>";
            } else {
                echo "Error logging mood."; // Handle any errors in execution
            }
        } else {
            echo "Prepared statement error."; // Handle any errors in prepared statement
        }

        $stmt->close(); // Close the prepared statement

        $conn->close(); // Close the database connection
    }
}
?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="moodtracking">
    <ol class="flex text-primary font-semibold dark:text-white-dark">
        <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
                class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
        </li>
        <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
                class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Mood
                Tracking</a></li>

    </ol>
    <br>

    <div x-data="charts">
        <div
            class="prose bg-[#f1f2f3] px-6 py-10 sm:px-10 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
            <h2 class="text-4xl md:text-5xl mb-4 mt-6 text-center dark:text-white-light">Track Your Mood</h2>
            <hr class="my-4 dark:border-[#191e3a]">
            <p class="text-center text-lg text-gray-600 dark:text-gray-400">Log how you feel today.</p>
            <p class="lead">
                <button type="button" x-on:click="window.location.href='/reportMood/moodsReport.php'"
                    class="btn btn-dark">View Moods Report</button>
            </p>
        </div>

        <br>
        <div class="panel">

            <form method="post" action="/moodTracking/index.php" id="logMoodForm">

                <label for="ctnSelect1"
                    class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mt-1 mb-2">Choose your
                    mood:</label>
                <select name="mood" id="ctnSelect1" class="form-select text-white-dark" required>
                    <option>Happy</option>
                    <option>Sad</option>
                    <option>Angry</option>
                    <option>Anxious</option>
                    <option>Relaxed</option>
                </select>

                <label for="description"
                    class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mt-4 mb-2">Describe your
                    mood:</label>
                <input type="text" name="description" placeholder="Description" class="form-input" required />
                <label for="rating" class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mt-4 mb-2">Mood
                    Intensity Level:</label>
                <input type="range" name="rating" class="w-full py-2.5" min="1" max="5" required
                    oninput="updateLevel(this.value)">
                <div id="rating-tooltip" class="hidden absolute bg-gray-800 text-white px-2 py-1 rounded text-sm">3
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">1: Very Low - 2: Low - 3: Moderate - 4: High - 5:
                    Very High</p>

                <div style="display: flex; gap: 10px;" class="mt-6">
                    <button type="submit" class="btn btn-primary">Log Mood</button>
                    <a href="/moodTracking/view.php" class="btn btn-secondary">View Logged Moods</a>

                </div>


            </form>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




    <?php include '../footer-main.php'; ?>