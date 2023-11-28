<?php
require '../config.php';

$edit_id = $existing_status = ''; // Initializing variables

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Fetch the existing appointment status and populate the form for editing
            $existing_status = $row['status'];
        } else {
            echo "Appointment not found.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edit_id = $_POST['edit_id'];
    $new_status = $_POST['new_status'];

    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("si", $new_status, $edit_id);
        if ($stmt->execute()) {
            header("Location: /appointmentAdmin/view.php?updateSuccess=true");
            exit;
        } else {
            echo "Error updating appointment status.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
    $conn->close();
}

include '../dashboardAdmin/header-main.php';
?>
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="../dashboardAdmin/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/appointmentAdmin/view.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Manage
            Appointments</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Update
            Status</a></li>
</ol>
<br>

<div class="panel">
    <form method="post" action="../appointmentAdmin/edit.php" class="form">
        <input type="hidden" name="edit_id" value="<?= $edit_id ?>">

        <div class="form-group">
            <label for="new_status">Appointment Status:</label>
            <select name="new_status" id="new_status" class="form-select">
                <option value="Pending" <?= ($existing_status === 'Pending') ? 'selected' : '' ?>>Pending</option>
                <option value="Completed" <?= ($existing_status === 'Completed') ? 'selected' : '' ?>>Completed</option>
                <option value="Accepted" <?= ($existing_status === 'Accepted') ? 'selected' : '' ?>>Accepted</option>
            </select>
        </div>
        <br>

        <div class="form-group">
            <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
        </div>
    </form>
</div>

<?php include '../footer-main.php'; ?>