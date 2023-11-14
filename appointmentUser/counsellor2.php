<?php
require '../config.php';


if (!isset($_SESSION['name']) || !isset($_SESSION['phone_number']) || !isset($_SESSION['date'])) {
    // Redirect back to the first page if session data is not set
    header("Location: counsellor1.php");
    exit();
}


// Retrieve the session data
$name = $_SESSION['name'];
$phone_number = $_SESSION['phone_number'];
$date = $_SESSION['date'];
$selectedCounsellor = $_SESSION['selectedCounsellor'];
$status = $_SESSION['status'];

// Query the database for available time slots based on the selected date
// You need to implement this part based on your database structure and business logic
// ...

// Example: Assuming you have an array of available time slots
$availableTimeSlots = ["10:00 AM", "11:00 AM", "2:00 PM", "3:00 PM"];

// ... (your existing code for session data cleanup)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedTime = $_POST['selected_time'];

    if (empty($selectedTime)) {
        echo "Please select a time slot.";
    } else {
        // Insert the booking into the database
        // You need to implement this part based on your database structure and business logic
        // ...

        // Display success message or handle errors
        // ...
    }
}

include '../header-main.php';

?>

<!-- Display available time slots and form for confirming booking -->
<div class="flex justify-center items-center h-screen">
    <div class="panel" style="width: 50rem;">
        <form method="post" action="/appointmentUser/counsellor2.php" id="confirmBooking">
            <!-- Display available time slots as buttons -->
            <?php foreach ($availableTimeSlots as $timeSlot): ?>
                <button type="submit" name="selected_time" value="<?= $timeSlot ?>"
                        class="btn <?= in_array($timeSlot, $bookedTimeSlots) ? 'btn-danger' : 'btn-primary' ?>">
                    <?= in_array($timeSlot, $bookedTimeSlots) ? 'Booked' : $timeSlot ?>
                </button>
            <?php endforeach; ?>
        </form>
    </div>
</div>

<?php include '../footer-main.php'; ?>