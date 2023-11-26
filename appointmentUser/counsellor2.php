<?php
require '../config.php'; // Include your database connection code
include '../header-main.php';

// Function to get available time slots for a specific date
function getAvailableTimeSlots($date, $conn) {
    // Query to get all booked time slots for the selected date
    $query = "SELECT time FROM appointments WHERE date = '$date'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch booked time slots
        $bookedTimeSlots = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookedTimeSlots[] = $row['time'];
        }

        // Define all possible time slots for the day
        $allTimeSlots = ['9:00 AM', '10:00 AM', '11:00 AM', '1:00 PM', '2:00 PM', '3:00 PM'];

        // Calculate available time slots
        $availableTimeSlots = array_diff($allTimeSlots, $bookedTimeSlots);

        return $availableTimeSlots;
    } else {
        // Handle query error
        die("Error: " . mysqli_error($conn));
    }
}

// Check if the date is selected
if (isset($_POST['submit'])) {
    $selectedDate = $_POST['date'];

    // Get available time slots for the selected date
    $availableTimeSlots = getAvailableTimeSlots($selectedDate, $conn);
}
?>

<!-- HTML form for selecting date -->
<form method="post" action="">
    <label for="date">Select Date:</label>
    <input type="date" name="date" required>
    <input type="submit" name="submit" value="Check Availability">
</form>

<!-- Display available time slots -->
<?php
if (isset($availableTimeSlots)) {
    if (count($availableTimeSlots) > 0) {
        echo "<h2>Available Time Slots for $selectedDate:</h2>";
        echo "<ul>";
        foreach ($availableTimeSlots as $timeSlot) {
            echo "<li>$timeSlot</li>";
        }
        echo "</ul>";
    } else {
        echo "<h2>No available time slots for $selectedDate</h2>";
    }
}
?>

<?php include '../footer-main.php'; ?>