<?php
require '../config.php'; // Include your database connection code

// Function to get counselor name based on ID
function getCounselorName($conn, $counselorId)
{
    $counselorQuery = "SELECT name FROM counselors WHERE id = ?";
    $counselorStmt = mysqli_prepare($conn, $counselorQuery);
    mysqli_stmt_bind_param($counselorStmt, "i", $counselorId);
    mysqli_stmt_execute($counselorStmt);

    // Bind the result variable by reference
    mysqli_stmt_bind_result($counselorStmt, $counselorName);

    // Fetch the result
    mysqli_stmt_fetch($counselorStmt);

    // Close the statement
    mysqli_stmt_close($counselorStmt);

    return $counselorName;
}

// Initialize available time slots array and selected date
$availableTimeSlots = [];
$selectedDate = '';
$successMessage = ''; // Initialize success message
$errorMessage = ''; // Initialize error message

// Check if the "Check Availability" button is clicked
if (isset($_POST['check_availability'])) {
    $selectedDate = $_POST['date'];

    // Validate that the selected date is not before the current date
    $currentDate = date('Y-m-d');
    if ($selectedDate < $currentDate) {
        $errorMessage = "Please select a date on or after the current date.";
    } else {
        $availableTimeSlots = getAvailableTimeSlots($selectedDate, $conn);
    }
}

// Check if the "Book Appointment" button is clicked
if (isset($_POST['submit'])) {
    // Trim whitespace and check if the selected date is not empty
    $selectedDate = trim($_POST['date']);
    if (empty($selectedDate)) {
        $errorMessage = "Please select a date before booking an appointment.";
    } else {
        // Fetch the counselor's ID based on the selected counselor name
        $counselorId = $_GET['id'];

        // Fetch the counselor's name based on the selected ID
        $counselor = getCounselorName($conn, $counselorId);

        if ($counselor !== null) {
            // Insert the appointment into the database
            $insertQuery = "INSERT INTO appointments (user_id, counselor_id, status, date, time) VALUES (?, ?, 'Pending', ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertQuery);
            $user_id = 1; // Replace with the actual user ID
            $selectedTime = $_POST['time'];

            mysqli_stmt_bind_param($insertStmt, "iiss", $user_id, $counselorId, $selectedDate, $selectedTime);

            // Execute the statement
            if (mysqli_stmt_execute($insertStmt)) {
                $successMessage = "Appointment booked successfully!";
            } else {
                $errorMessage = "Error booking appointment: " . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($insertStmt);
        } else {
            $errorMessage = "Counselor not found.";
        }
    }
}

function getAvailableTimeSlots($date, $conn)
{
    // Query to get all booked time slots for the selected date
    $query = "SELECT time FROM appointments WHERE date = ?";

    // Use prepared statement
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $date);
    mysqli_stmt_execute($stmt);

    // Check for errors
    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        // Fetch booked time slots
        $bookedTimeSlots = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookedTimeSlots[] = $row['time'];
        }

        // Define all possible time slots for the day
        $allTimeSlots = ['9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', '2:00 PM', '3:00 PM'];

        // Calculate available time slots using strtotime for more reliable comparison
        $availableTimeSlots = array_values(array_filter($allTimeSlots, function ($timeSlot) use ($bookedTimeSlots) {
            return !in_array($timeSlot, $bookedTimeSlots);
        }));

        return $availableTimeSlots;
    } else {
        // Handle query error
        die("Error: " . mysqli_error($conn));
    }
}

include '../header-main.php';
?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/appointmentUser/index.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Appointment</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">
            <?php echo getCounselorName($conn, $_GET['id']); ?>
        </a></li>

</ol>
<br>

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="panel sm:w-[480px] m-6 max-w-lg w-full bg-white rounded-lg p-6 shadow-md">
        <h2 class="text-2xl font-semibold mb-4 text-center">Book an Appointment</h2>
        <p class="lead my-2 text-center text-lg text-gray-600 dark:text-gray-400">
            <?php echo getCounselorName($conn, $_GET['id']); ?>
        </p>

        <!-- Check Availability Form -->
        <form method="post" action="" class="mb-4">
            <label for="date" class="block mb-2">Select Date:</label>
            <input type="date" name="date" required value="<?php echo $selectedDate; ?>" class="form-input mb-4">

            <button type="submit" name="check_availability" class="btn btn-primary w-full">Check Availability</button>
        </form>

        <!-- Display available time slots -->
        <?php
        if (!empty($availableTimeSlots)) {
            echo "<div class='mb-4'>";
            echo "<h5 style='font-weight: 600;' class='mb-2'>Available Time Slots for $selectedDate:</h5>";
            echo "<ul>";
            foreach ($availableTimeSlots as $timeSlot) {
                echo "<li>$timeSlot</li>";
            }
            echo "</ul>";
            echo "</div>";
        }
        ?>

        <!-- Book Appointment Form -->
        <?php if (isset($availableTimeSlots) && !empty($availableTimeSlots)): ?>
            <form method="post" action="">
                <!-- Add a hidden input field to carry over the selected date -->
                <input type="hidden" name="date" value="<?php echo htmlspecialchars($selectedDate); ?>">

                <label for="time" class="block mb-2">Select Time:</label>
                <select name="time" required class="form-input mb-4">
                    <?php
                    foreach ($availableTimeSlots as $timeSlot) {
                        echo "<option value=\"$timeSlot\">$timeSlot</option>";
                    }
                    ?>
                </select>

                <button type="submit" name="submit" class="btn btn-primary w-full">Book Appointment</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
    // Display SweetAlert2 notifications based on PHP messages
    document.addEventListener('DOMContentLoaded', function () {
        <?php
        if (!empty($successMessage)) {
            echo "coloredToast('success', '$successMessage');";
        } elseif (!empty($errorMessage)) {
            echo "coloredToast('error', '$errorMessage');";
        }
        ?>

        // Function to display SweetAlert2 notifications
        function coloredToast(icon, message) {
            const toast = window.Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                showCloseButton: true,
                customClass: {
                    popup: 'background-color: #5cb85c; color: white; border-radius: 5px;' // Inline styles for success color
                }
            });

            if (icon === 'success') {
                toast.fire({
                    title: message,
                    icon: 'success'
                });
            } else if (icon === 'error') {
                toast.fire({
                    title: message,
                    icon: 'error'
                });
            }
        }
    });
</script>

<?php include '../footer-main.php'; ?>