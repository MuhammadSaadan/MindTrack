<?php
require '../config.php';

$edit_id = $existing_mood = $existing_description = $existing_rating = ''; // Initializing variables

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM log_mood WHERE log_id = ?"; // Assuming 'log_id' is the primary key
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Fetch the existing mood details and populate the form for editing
            $existing_mood = $row['mood'];
            $existing_description = $row['description'];
            $existing_rating = $row['rating'];
        } else {
            echo "Mood entry not found.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edit_id = $_POST['edit_id'];
    $mood = $_POST['mood'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];

    $sql = "UPDATE log_mood SET mood = ?, description = ?, rating = ? WHERE log_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssi", $mood, $description, $rating, $edit_id);
        if ($stmt->execute()) {
       

            header("Location: /moodTracking/view.php?updateSuccess=true");
            exit;

        } else {
            echo "Error updating mood.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
    $conn->close();
}

include '../header-main.php';
?>

<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php" class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/moodTracking/index.php"class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mood Tracking</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/moodTracking/view.php"class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">View Logged Moods</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Edit Moods</a></li>
</ol>
<br>

<div class="panel">

<form method="post" action="/moodTracking/edit.php">
    <input type="hidden" name="edit_id" value="<?= $edit_id ?>">
    <label for="ctnSelect1">Choose your moods:</label>
    <select name="mood" value="<?= $existing_mood?>" id="ctnSelect1"  class="form-select text-white-dark" required>
                    <option>Happy</option>
                    <option>Sad</option>
                    <option>Angry</option>
                    <option>Anxious</option>
                    <option>Relaxed</option>
                </select>

    <label for="description" class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mt-1 mb-2">Describe your mood:</label>

    <input type="text" name="description" value="<?= $existing_description ?>" class="form-input" required />
    
    <label for="rating" class="block text-sm font-semibold text-gray-600 dark:text-gray-400 mt-1 mb-2">Mood intensity level:</label>

    <input type="range" name="rating" value="<?= $existing_rating ?>" class="w-full py-2.5" min="1" max="5" />
    <p class="text-sm text-gray-500 dark:text-gray-400">1: Very Low - 2: Low - 3: Moderate - 4: High - 5: Very High</p>


    <button type="submit" class="btn btn-primary mt-6">Update Mood:</button>
        <div id="success-toast"></div>

</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<?php include '../footer-main.php'; ?>

