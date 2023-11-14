<?php
// Replace this with your database connection code
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date'])) {
    $selectedDate = $_GET['date'];

    // Fetch available times for the selected date from your database
    $sql = "SELECT DISTINCT time FROM appointments WHERE date = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $selectedDate);
        $stmt->execute();
        $result = $stmt->get_result();

        $availableTimes = [];
        while ($row = $result->fetch_assoc()) {
            $availableTimes[] = $row['time'];
        }

        echo json_encode($availableTimes);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle invalid requests
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>