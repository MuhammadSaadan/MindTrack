<?php
// Include necessary files and initialize the session, etc.

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    // Assuming you pass the appointment ID through the URL parameter 'edit_id'
    $editId = $_GET['edit_id'];

    // Fetch the appointment data for the given ID
    $sql = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $editId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $appointment = $result->fetch_assoc();
    } else {
        // Handle the case where the appointment with the specified ID is not found
        // Redirect or display an error message as needed
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $newStatus = $_POST['status'];
    $editId = $_POST['edit_id'];

    // Update the appointment status in the database
    $updateSql = "UPDATE appointments SET status = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $newStatus, $editId);
    $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
        // Redirect or display a success message as needed
    } else {
        // Handle the case where the update failed
    }
}

// Rest of your HTML and PHP code for rendering the form

?>

<!-- Your HTML form for updating the appointment status -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <input type="hidden" name="edit_id" value="<?php echo $appointment['id']; ?>">

    <label for="status">Appointment Status:</label>
    <select name="status" id="status">
        <option value="Pending" <?php echo ($appointment['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
        <option value="Completed" <?php echo ($appointment['status'] === 'Completed') ? 'selected' : ''; ?>>Completed
        </option>
        <option value="Accepted" <?php echo ($appointment['status'] === 'Accepted') ? 'selected' : ''; ?>>Accepted
        </option>
    </select>

    <button type="submit" name="update_status">Update Status</button>
</form>