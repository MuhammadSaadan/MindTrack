<?php
require '../dashboardCounsellor/config.php';
include '../dashboardCounsellor/header-main.php';
?>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

<?php
$users = array();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch user details
    $userSql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($userSql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $userResult = $stmt->get_result();
    $user = $userResult->fetch_assoc();

    // Fetch log_mood entries
    $logMoodSql = "SELECT * FROM log_mood WHERE user_id = ?";
    $stmt = $conn->prepare($logMoodSql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $logMoodResult = $stmt->get_result();
    $logMoods = $logMoodResult->fetch_all(MYSQLI_ASSOC);

    // Fetch log_symptoms entries
    $logSymptomsSql = "SELECT * FROM log_symptoms WHERE user_id = ?";
    $stmt = $conn->prepare($logSymptomsSql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $logSymptomsResult = $stmt->get_result();
    $logSymptoms = $logSymptomsResult->fetch_all(MYSQLI_ASSOC);

    // Fetch ph9_question entries
    $ph9Sql = "SELECT * FROM ph9_question WHERE user_id = ?";
    $stmt = $conn->prepare($ph9Sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $ph9Result = $stmt->get_result();
    $ph9Questions = $ph9Result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
}

?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="../dashboardCounsellor/index.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="../counsellorReport/index.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">View
            User Report</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]">
        <a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">
            <?= isset($user['name']) ? $user['name'] . "'s Report" : 'User Report' ?>
        </a>
    </li>

</ol>
<br>

<!-- Display user information -->
<div class="panel">
    <h2 class="font-bold text-2xl mb-3">
        <?= isset($user['name']) ? $user['name'] . "'s Report" : 'User Report' ?>
    </h2>
    <p>Email:
        <?= isset($user['email']) ? $user['email'] : 'N/A' ?>
    </p>
    <p>Phone Number:
        <?= isset($user['phone']) ? $user['phone'] : 'N/A' ?>
    </p>
</div>
<br>
<!-- Display log_mood entries -->


<br>

<!-- Display log_symptoms entries -->
<div class="panel">
    <h2 class="font-bold text-2xl mb-3">Mood Logs</h2>
    <div class="table-responsive">
        <table id="moodsTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Symptom</th>
                    <th>Description</th>
                    <th>Intensity Level</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                

                foreach ($logMoods as $mood):
                    ?>
                    <tr id="row-<?= $mood['log_id'] ?>">
                        <td>
                            <?= $currentNumber ?>
                        </td>
                        <td>
                            <?= $mood['mood'] ?>
                        </td>
                        <td>
                            <?= $mood['description'] ?>
                        </td>
                        <td>
                            <?= $mood['rating'] ?>
                        </td>
                        <td>
                            <?= $mood['logged_at'] ?>
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

<!-- Display log_symptoms entries -->
<div class="panel">
    <h2 class="font-bold text-2xl mb-3">Symptom Logs</h2>
    <div class="table-responsive">
        <table id="symptomsTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Symptom</th>
                    <th>Description</th>
                    <th>Intensity Level</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                
                foreach ($logSymptoms as $symptom):
                    ?>
                    <tr>
                        <td>
                            <?= $currentNumber ?>
                        </td>
                        <td>
                            <?= $symptom['symptom'] ?>
                        </td>
                        <td>
                            <?= $symptom['description'] ?>
                        </td>
                        <td>
                            <?= $symptom['rating'] ?>
                        </td>
                        <td>
                            <?= $symptom['logged_at'] ?>
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
<!-- Display ph9_question entries -->
<div class="panel">
    <h2 class="font-bold text-2xl mb-3">PHQ-9 Questions Logs</h2>
    <div class="table-responsive">
        <table id="SeverityTable" class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Severity</th>
                    <th>Comment</th>
                    <th>Score</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentNumber = 1; // Initialize the counter for row numbering
                
                foreach ($ph9Questions as $severity):
                    ?>
                    <tr>
                        <td>
                            <?= $currentNumber ?>
                        </td>
                        <td>
                            <?= $severity['severity'] ?>
                        </td>
                        <td>
                            <?= $severity['comment'] ?>
                        </td>
                        <td>
                            <?= $severity['total'] ?>
                        </td>
                        <td>
                            <?= $severity['logged_at'] ?>
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
</div>

<?php include '../footer-main.php'; ?>

<!-- Include the SimpleDatatables script -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize SimpleDatatables for each table
        new simpleDatatables.DataTable('#moodsTable');
        new simpleDatatables.DataTable('#symptomsTable');
        new simpleDatatables.DataTable('#SeverityTable');
    });
</script>