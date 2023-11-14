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

    $sql = "SELECT * FROM appointments WHERE user_id = $user_id ORDER BY id ASC";
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
            position: 'bottom-start',
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
                position: 'bottom-start',
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
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php" class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/appointmentUser/index.php"class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Appointment</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/appointmentUser/book.php"class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Book Appointment</a></li>

    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">View Appointments</a></li>
</ol>
<br>

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
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
    <?php 
    $currentNumber = 1; // Initialize the counter for row numbering

    foreach ($log_appointments as $set) :
    ?>
    <tr id="row-<?= $set['id'] ?>">
        <td><?= $currentNumber ?></td> <!-- Display the current row number -->
        <td><?= $set['name'] ?></td>
        <td><?= $set['phone_number'] ?></td>
        <td><?= $set['date'] ?></td>
        <td><?= $set['time'] ?></td>
        <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
            <div style="display: flex; gap: 10px;">
                <a href="/moodTracking/edit.php?edit_id=<?= $set['id'] ?>" class="btn btn-primary btn-sm mr-2">Edit</a>

                <!-- Update the delete button to call the showAlert function -->
                <button type="button" class="btn btn-danger btn-sm" onclick="showAlert(<?= $set['id'] ?>)">Delete</button>
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

<!-- Include SimpleDataTables JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#moodsTable');
     
}
    );

    async function showAlert(logappointments) {
        const swalWithBootstrapButtons = window.Swal.mixin({
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
        .fire({
            title: '<div style="text-align: center;">Are you sure?</div>',
           // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            padding: '2em',
        })
        .then((result) => {
            if (result.value) {
                // Pass the logId to the PHP script for deletion
                deleteLog(logappointments);
            } 
            //else if (result.dismiss === window.Swal.DismissReason.cancel) {
                //swalWithBootstrapButtons.fire('<div style="text-align: center;">Cancelled</div>');
           // }
        });
    }

    async function deleteLog(logappointments) {
    const formData = new FormData();
    formData.append('delete_id', logappointments);

    try {
        const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
           // const swalWithBootstrapButtons = window.Swal.mixin({
                //confirmButtonClass: 'btn btn-secondary',
                //cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
                //buttonsStyling: false,
           

            // If deletion was successful, display the success message
                   //swalWithBootstrapButtons.fire('Mood Deleted');

            // Reload the page after a short delay (e.g., 1.5 seconds)
            setTimeout(() => {
                window.location.reload();
            }, 1500); // Adjust the delay time as needed
        } else {
            // If deletion failed, display an error message
            swalWithBootstrapButtons.fire('Error', 'Failed to delete', 'error');
        }
    } catch (error) {
        // Handle any unexpected errors
        swalWithBootstrapButtons.fire('Error', 'An unexpected error occurred.', 'error');
    }
}


</script>

<?php include '../footer-main.php'; ?>