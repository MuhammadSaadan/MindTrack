<?php
require '../config.php';
include '../dashboardAdmin/header-main.php';
?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<?php
$counselors = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you want to retrieve all counselors
    $counselorSql = "SELECT * FROM counselors ORDER BY id ASC";

    $counselorResult = $conn->query($counselorSql);

    if ($counselorResult->num_rows > 0) {
        while ($counselorRow = $counselorResult->fetch_assoc()) {
            $counselors[] = $counselorRow;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_counselor_id'])) {
    $counselorId = $_POST['delete_counselor_id'];

    $stmt = $conn->prepare("DELETE FROM counselors WHERE id = ?");
    $stmt->bind_param("i", $counselorId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['counselor_deletion_success'] = true;
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error deleting counselor: " . $conn->error;
    }
}

if (isset($_SESSION['counselor_deletion_success']) && $_SESSION['counselor_deletion_success'] === true) {
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
            title: 'Counselor Deleted',
            icon: 'success'
        });
    </script>";
    unset($_SESSION['counselor_deletion_success']); // Clear the success message
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
            Counsellors</a></li>
</ol>
<br>

<div class="panel">

    <div class="table-responsive">
        <table id="counselorsTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Specialization</th>
                    <th>Languages</th>
                    <th>Experience</th>
                    <th>Education</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                foreach ($counselors as $counselor):
                    ?>
                    <tr id="row-counselor-<?= $counselor['id'] ?>">
                        <td>
                            <?= $currentNumber ?>
                        </td>
                        <td>
                            <?= $counselor['name'] ?>
                        </td>
                        <td>
                            <?= $counselor['email'] ?>
                        </td>
                        <td>
                            <?= $counselor['phone_number'] ?>
                        </td>
                        <td>
                            <?= $counselor['specialization'] ?>
                        </td>
                        <td>
                            <?= $counselor['languages'] ?>
                        </td>
                        <td>
                            <?= $counselor['experience'] ?>
                        </td>
                        <td>
                            <?= $counselor['education'] ?>
                        </td>
                        <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                            <div style="display: flex; gap: 10px;">
                                <a href="../counselLorAdmin/edit.php?edit_id=<?= $counselor['id'] ?>"
                                    class="btn btn-primary btn-sm mr-2">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="showCounselorAlert(<?= $counselor['id'] ?>)">Delete Counsellor</button>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $currentNumber++; // Increment the counter for the next row
                endforeach;
                ?>
            </tbody>
        </table>
        <br>
        <p class="lead">
            <button type="button" x-on:click="window.location.href='../counsellorAdmin/register.php'"
                class="btn btn-primary">Register Counsellor</button>
        </p>
    </div>
</div>
<br>


<?php include '../footer-main.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#counselorsTable');
    });

    function showCounselorAlert(counselorId) {
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
                confirmButtonText: 'Delete Counselor',
                cancelButtonText: 'Back',
                reverseButtons: true,
                padding: '2em',
            })
            .then((result) => {
                if (result.value) {
                    // Pass the counselorId to the PHP script for deletion
                    deleteCounselor(counselorId);
                }
            });
    }

    async function deleteCounselor(counselorId) {
        const formData = new FormData();
        formData.append('delete_counselor_id', counselorId);

        try {
            const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                // If deletion was successful, display the success message
                window.location.reload();
            } else {
                // If deletion failed, display an error message
                swalWithBootstrapButtons.fire('Error', 'Failed to delete counselor', 'error');
            }
        } catch (error) {
            // Handle any unexpected errors
            swalWithBootstrapButtons.fire('Error', 'An unexpected error occurred.', 'error');
        }
    }
</script>