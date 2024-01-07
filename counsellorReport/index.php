<?php
require '../dashboardCounsellor/config.php';
include '../dashboardCounsellor/header-main.php';
?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<?php
$users = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Assuming you want to retrieve all users
    $userSql = "SELECT * FROM users ORDER BY id ASC";

    $userResult = $conn->query($userSql);

    if ($userResult->num_rows > 0) {
        while ($userRow = $userResult->fetch_assoc()) {
            $users[] = $userRow;
        }
    }
}



$conn->close();
?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="../dashboardCounsellor/index.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">View
            User Report
        </a></li>
</ol>
<br>

<div class="panel">

    <div class="table-responsive">
        <table id="usersTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <!-- Add additional columns as per your user table structure -->
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                foreach ($users as $user):
                    ?>
                    <tr id="row-user-<?= $user['id'] ?>">
                        <td>
                            <?= $currentNumber ?>
                        </td>

                        <td>
                            <?= $user['name'] ?>
                        </td>
                        <td>
                            <?= $user['email'] ?>
                        </td>
                        <td>
                            <?= $user['phone'] ?>
                        </td>
                        <!-- Add additional columns as per your user table structure -->
                        <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                            <div style="display: flex; gap: 10px;">

                                <a href="../counsellorReport/report.php?user_id=<?= $user['id'] ?>"
                                    class="btn btn-primary btn-sm mr-2">View Report</a>

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
<br>


<?php include '../footer-main.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new simpleDatatables.DataTable('#usersTable');
    });



</script>