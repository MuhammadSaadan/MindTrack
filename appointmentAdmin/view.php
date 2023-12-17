<?php
require '../config.php';
include '../dashboardAdmin/header-main.php';
?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<?php
$appointments = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you want to retrieve all appointments
    $sql = "SELECT appointments.*, users.name, users.phone, users.email, counselors.name AS counselor_name
    FROM appointments 
    INNER JOIN users ON appointments.user_id = users.id
    INNER JOIN counselors ON appointments.counselor_id = counselors.id
    ORDER BY appointments.id ASC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $logAppointmentId = $_POST['delete_id'];
    $counselorId = $_POST['counselor_id'];

    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ? AND counselor_id = ?");
    $stmt->bind_param("ii", $logAppointmentId, $counselorId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['deletion_success'] = true;
        unset($_SESSION['update_success']);
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
                title: 'Status Updated',
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
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="../dashboardAdmin/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Manage
            Appointments</a></li>
</ol>
<br>

<div class="panel">

    <div class="table-responsive">
        <table id="symptomsTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>E-mail</th>
                    <th>Counsellor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                foreach ($appointments as $appointment):
                    ?>
                    <tr id="row-<?= $appointment['id'] ?>">
                        <td>
                            <?= $currentNumber ?>
                        </td>
                        <td>
                            <?= $appointment['name'] ?>
                        </td>
                        <td>
                            <?= $appointment['phone'] ?>
                        </td>
                        <td>
                            <?= $appointment['email'] ?>
                        </td>
                        <td>
                            <?= $appointment['counselor_name'] ?>
                        </td>
                        <td>
                            <?= $appointment['date'] ?>
                        </td>
                        <td>
                            <?= $appointment['time'] ?>
                        </td>
                        <td>
                            <?= $appointment['status'] ?>
                        </td>
                        <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                            <div style="display: flex; gap: 10px;">
                                <a href="../appointmentAdmin/edit.php?edit_id=<?= $appointment['id'] ?>"
                                    class="btn btn-primary btn-sm mr-2">Update</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="showAlert(<?= $appointment['id'] ?>, <?= $appointment['counselor_id'] ?>)">Cancel
                                    Appointment</button>
                            </div>
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

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#symptomsTable');

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