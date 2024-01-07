<?php
session_start();
include '../connect.php';
include '../header-main.php';

?>

<!-- Include SimpleDataTables CSS -->
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<?php
$log_appointments = array();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT appointments.*, users.name AS user_name, users.phone AS user_phone, counselors.name AS counselor_name
    FROM appointments
    INNER JOIN users ON appointments.user_id = users.id
    INNER JOIN counselors ON appointments.counselor_id = counselors.id
    WHERE appointments.user_id = $user_id
    ORDER BY appointments.id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $log_appointments[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $logappointments = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $logappointments);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['deletion_success'] = true;
        unset($_SESSION['update_success']); // Unset the update success session variable
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();

    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_SESSION['deletion_success']) && $_SESSION['deletion_success'] === true) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        const toast = window.Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            showCloseButton: true,
            customClass: {
                popup: 'background-color: #5cb85c; color: white; border-radius: 5px;'
            }
        });
        toast.fire({
            title: 'Appointment Updated',
            icon: 'success'
        });
    </script>";
    unset($_SESSION['deletion_success']); // Clear the success message
}


if (isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == 'true') {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        const coloredToast = () => {
            const toast = window.Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                showCloseButton: true,
                customClass: {
                    popup: 'background-color: #5cb85c; color: white; border-radius: 5px;'
                }
            });
            toast.fire({
                title: 'Appointment Updated',
                icon: 'success'
            });
        };
        coloredToast();
    </script>";
    unset($_SESSION['updateSuccess']); // Clear the success message

}


$conn->close();
?>


<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/appointmentUser/index2.php"
            class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Appointment</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">View
            Appointments</a></li>
</ol>
<br>



<style>
    .appointment-grid {
        display: flex;
        flex-wrap: wrap;
    }

    .appointment-card {
        flex: 0 0 calc(19rem - 20px);
        margin-bottom: 20px;
        margin-right: 20px;
        /* Add this line */
    }

    .appointment-card:last-child {
        margin-right: 0;
        /* Remove right margin for the last item */
    }
</style>

<div class="panel">
    <div class="flex items-center space-x-4">
        <h5 class="text-lg text-gray-600 dark:text-gray-400"><strong>Upcoming Appointments</strong></h5>
    </div>
</div>
<br>

<div class="appointment-grid">
    <?php foreach ($log_appointments as $appointment): ?>
        <?php if ($appointment['status'] !== 'Completed'): ?>
            <div
                class="appointment-card bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">
                        <?= $appointment['counselor_name'] ?>
                    </h5>
                    <p class="text-white-dark">
                    Date:
                    <?= $appointment['date'] ?><br>
                    Time:
                    <?= $appointment['time'] ?><br>
                    Status:
                    <?= $appointment['status'] ?>
                    </p>
                    <br>
                    <!-- Add Cancel Button -->
                    <a class="btn btn-danger btn-sm" onclick="showAlert(<?= $appointment['id'] ?>)">Cancel
                        Appointment</a>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>



<div class="panel">

    <div class="table-responsive">
        <table id="moodsTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Counsellor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                
                foreach ($log_appointments as $set):
                    ?>
                    <tr id="row-<?= $set['id'] ?>">
                        <td>
                            <?= $currentNumber ?>
                        </td> <!-- Display the current row number -->
                        <td>
                            <?= $set['user_name'] ?>
                        </td>
                        <td>
                            <?= $set['user_phone'] ?>
                        </td>
                        <td>
                            <?= $set['date'] ?>
                        </td>
                        <td>
                            <?= $set['time'] ?>
                        </td>
                        <td>
                            <?= $set['counselor_name'] ?>
                        </td>
                        <td>
                            <?= $set['status'] ?>
                        </td>


                    </tr>
                    <?php
                    $currentNumber++; // Increment the counter for the next row
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../footer-main.php'; ?>

<!-- Include SimpleDataTables JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#moodsTable');

    }
    );

    function showAlert(appointmentId, counselorId) {
        const swalWithBootstrapButtons = window.Swal.mixin({
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: '<div style="text-align: center;">Are you sure?</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Cancel Appointment',
                cancelButtonText: 'Back',
                reverseButtons: true,
                padding: '2em',
            })
            .then((result) => {
                if (result.value) {
                    // Pass the appointmentId and counselorId to the PHP script for cancellation
                    deleteAppointment(appointmentId, counselorId);
                }
            });
    }
    async function deleteAppointment(appointmentId, counselorId) {
        const formData = new FormData();
        formData.append('delete_id', appointmentId);
        formData.append('counselor_id', counselorId);

        try {
            const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                // If cancellation was successful, display the success message
                window.location.reload();
            } else {
                // If cancellation failed, display an error message
                swalWithBootstrapButtons.fire('Error', 'Failed to cancel appointment', 'error');
            }
        } catch (error) {
            // Handle any unexpected errors
            swalWithBootstrapButtons.fire('Error', 'An unexpected error occurred.', 'error');
        }
    }


</script>

<?php include '../footer-main.php'; ?>