<?php
require '../config.php';
include '../header-main.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for confirming the booking
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Additional fields for dynamic values
    $selectedCounsellor = 'Dr.Aishah Rahman';
    $status = 'Pending';

    // Perform basic validation
    if (empty($user_id) || empty($name) || empty($phone_number) || empty($date) || empty($time)) {
        echo "All fields are required.";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "INSERT INTO appointments (user_id, name, phone_number, counsellor, status, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("issssss", $user_id, $name, $phone_number, $selectedCounsellor, $status, $date, $time);
            if ($stmt->execute()) {
                echo "Appointment Booked Successfully";
                // Redirect to the dashboard or another confirmation page if needed
                // header('Location: /dashboardUser/dashboard.php');
                // exit();
            } else {
                echo "Error logging mood."; // Handle any errors in execution
            }
        } else {
            echo "Prepared statement error."; // Handle any errors in prepared statement
        }

        $stmt->close(); // Close the prepared statement
    }
}

?>

<!-- Your existing HTML code for confirmation page -->

<?php include '../footer-main.php'; ?>