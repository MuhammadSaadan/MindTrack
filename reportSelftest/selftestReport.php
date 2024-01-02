<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<?php

session_start();
include '../connect.php'; // Include the connection file


if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
    $userName = 'User'; // Default name

    $userId = $_SESSION['user_id'];
    $query = "SELECT name FROM users WHERE id = $userId";

    $result = $conn->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (isset($row['name'])) {
                $userName = $row['name'];
            }
        }
    }
} else {
    // Redirect if the user is not logged in
    header("Location: ../index.php");
    exit();
}

// Query for total logged Severity
$totalSeverityQuery = "SELECT COUNT(*) AS totalSeverity FROM ph9_question WHERE user_id = $userId";
$totalSeverityResult = $conn->query($totalSeverityQuery);

// Get the result
$totalSeverity = $totalSeverityResult->fetch_assoc()['totalSeverity'];
// Query for highest frequency overall
$queryOverall = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId GROUP BY severity ORDER BY frequency DESC LIMIT 1";
$resultOverall = $conn->query($queryOverall);

// Get the result
$highestFrequencyOverall = $resultOverall->fetch_assoc();

// Query for highest frequency in the last 7 days
$query7Days = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId AND logged_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY severity ORDER BY frequency DESC LIMIT 1";
$result7Days = $conn->query($query7Days);

// Get the result
$highestFrequency7Days = $result7Days->fetch_assoc();

// Query for highest frequency in the last 30 days
$query30Days = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId AND logged_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY severity ORDER BY frequency DESC LIMIT 1";
$result30Days = $conn->query($query30Days);

// Get the result
$highestFrequency30Days = $result30Days->fetch_assoc();


// Fetch severity data from the database
$severityQuery = "SELECT severity, COUNT(*) as count FROM ph9_question WHERE user_id = $userId GROUP BY severity";
$severityResult = $conn->query($severityQuery);

// For 7 days
$sevenDaysQuery = "SELECT severity, COUNT(*) as count FROM ph9_question WHERE user_id = $userId AND logged_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY severity";
$sevenDaysResult = $conn->query($sevenDaysQuery);

// For 30 days
$thirtyDaysQuery = "SELECT severity, COUNT(*) as count FROM ph9_question WHERE user_id = $userId AND logged_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY severity";
$thirtyDaysResult = $conn->query($thirtyDaysQuery);

// Fetch severity data grouped by month and year
$monthlyseverityQuery = "SELECT MONTH(logged_at) as month, severity, COUNT(*) as count FROM ph9_question WHERE user_id = $userId AND YEAR(logged_at) = YEAR(NOW()) GROUP BY month, severity";
$monthlyseverityResult = $conn->query($monthlyseverityQuery);

// Query for overall severity distribution
$queryseverityDistribution = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId GROUP BY severity ORDER BY frequency DESC";
$resultseverityDistribution = $conn->query($queryseverityDistribution);

// Get the result
$severityDistributionData = $resultseverityDistribution->fetch_all(MYSQLI_ASSOC);

$ph9_question = array();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM ph9_question WHERE user_id = $user_id ORDER BY id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ph9_question[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $logId = $_POST['delete_id'];

    $stmt = $conn->prepare("DELETE FROM ph9_question WHERE id = ?");
    $stmt->bind_param("i", $logId);
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
            title: 'severity Updated',
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
                title: 'severity Updated',
                icon: 'success'
            });
        };
        coloredToast();
    </script>";
    unset($_SESSION['updateSuccess']); // Clear the success message

}


$conn->close();
include '../header-main.php';

?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/reportseverity/SeverityReport.php"
            class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mental
            Health Report</a></li>

    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Severity
            Report</a>

    </li>


</ol>
<br>

<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">You have a record of
            <?php echo $totalSeverity; ?> Self Assessment Test
        </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Below are the stats for your logged
            Severity</p>
        <p class="lead">
            <button type="button" x-on:click="window.location.href='/selfTest/index.php'" class="btn btn-dark">Learn
                more...</button>
        </p>
    </div>

    <br>


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10"> <!-- Adjusted gap-10 to gap-1rem -->
        <!-- overall severity pie chart -->
        <div x-ref="severityPieChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-1rem text-center text-lg text-gray-600 dark:text-gray-400">Overall Severity</p>
            <div x-ref="severityPieChart" style="height: 18.75rem;"></div>
        </div>

        <div
            class="bg-dark border border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-1rem text-center flex flex-col justify-center">
            <h3 class="text-2xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                <?php echo "Your overall severity is,"; ?>
            </h3>
            <h3 class="text-5xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                <?php echo isset($highestFrequencyOverall['severity']) ? $highestFrequencyOverall['severity'] : 'No data recorded'; ?>
            </h3>
            <p class="text-white-light text-[0.9375rem] mb-0.21875rem text-center"></p>
        </div>

        <!-- 7 days -->
        <div x-ref="sevenDaysChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-1rem text-center text-lg text-gray-600 dark:text-gray-400">Your Frequent Severity (7 Days)
            </p>
            <div x-ref="sevenDaysChart" style="height: 18.75rem;"></div>
        </div>
        <div
            class="bg-dark border border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-1rem text-center flex flex-col justify-center">
            <h3 class="text-2xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                Your Severity is,
            </h3>
            <h3 class="text-5xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                <?php echo isset($highestFrequency7Days['severity']) ? $highestFrequency7Days['severity'] : 'No data recorded'; ?>
            </h3>
            <h3 class="text-2xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                for the past week.
            </h3>
            <p class="text-white-light text-[0.9375rem] mb-0.21875rem text-center"></p>
        </div>

        <!-- 30 days -->
        <div x-ref="thirtyDaysChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-1rem text-center text-lg text-gray-600 dark:text-gray-400">Your Frequent Severity (30
                Days)</p>
            <div x-ref="thirtyDaysChart" style="height: 18.75rem;"></div>
        </div>
        <div
            class="bg-dark border border-gray-500/20 rounded-md shadow-[rgb(31_45_61_/_10%)_0px_2px_10px_1px] dark:shadow-[0_2px_11px_0_rgb(6_8_24_/_39%)] p-1rem text-center flex flex-col justify-center">
            <h3 class="text-2xl font-semibold mb-1rem text-white-light text-[0.3125rem] text-center">
                Your Severity is,
            </h3>
            <h3 class="text-5xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                <?php echo isset($highestFrequency30Days['severity']) ? $highestFrequency30Days['severity'] : 'No data recorded'; ?>
            </h3>
            <h3 class="text-2xl font-semibold mb-1rem text-white-light text-[5px;] text-center">
                for the past month.
            </h3>
            <p class="text-white-light text-[0.9375rem] mb-0.21875rem text-center"></p>
        </div>
    </div>
    <br>

    <div x-ref="severityPyramidChart" class="bg-white dark:bg-black rounded-lg">
        <p class="lead mt-1rem text-center text-lg text-gray-600 dark:text-gray-400">Overall Severity Chart</p>
        <div x-ref="severityPyramidChart" style="height: 18.75rem;"></div>
    </div>

    <br>

    <div class="panel">

        <div class="table-responsive">
            <table id="SeverityTable" class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>severity</th>
                        <th>Comment</th>
                        <th>Score</th>
                        <th>Date and Time</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentNumber = 1; // Initialize the counter for row numbering
                    
                    foreach ($ph9_question as $severity):
                        ?>
                        <tr id="row-<?= $severity['id'] ?>">
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
                            <td class="p-3 border-b border-[#ebedf2] dark:border-[#191e3a] text-center">
                                <div style="display: flex; gap: 10px;">


                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="showAlert(<?= $severity['id'] ?>)">Delete</button>
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



    <!-- Include the required libraries -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- scripts -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("charts", () => ({
                severityPieChart: null,
                sevenDaysChart: null,
                thirtyDaysChart: null,
                severityPyramidChart: null,
                init() {
                    let isDark;

                    // severity data
                    const severityData = <?php echo json_encode($severityResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const Severityeries = severityData.map(entry => entry.count);
                    const severityLabels = severityData.map(entry => entry.severity);

                    // 7 Days data
                    const sevenDaysData = <?php echo json_encode($sevenDaysResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const sevenDaysSeries = sevenDaysData.map(entry => entry.count);
                    const sevenDaysLabels = sevenDaysData.map(entry => entry.severity);

                    // 30 Days data
                    const thirtyDaysData = <?php echo json_encode($thirtyDaysResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const thirtyDaysSeries = thirtyDaysData.map(entry => entry.count);
                    const thirtyDaysLabels = thirtyDaysData.map(entry => entry.severity);

                    // Fetch severity data grouped by month and year
                    const monthlyseverityData = <?php echo json_encode($monthlyseverityResult->fetch_all(MYSQLI_ASSOC)); ?>;

                    // Extract unique months
                    const uniqueMonths = Array.from(new Set(monthlyseverityData.map(entry => entry.month)));

                    const severityDistributionData = <?php echo json_encode($severityDistributionData); ?>;
                    const severityDistributionLabels = severityDistributionData.map(entry => entry.severity);
                    const severityDistributionSeries = severityDistributionData.map(entry => entry.frequency);


                    const normalizeData = (data) => {
                        const sum = data.reduce((acc, val) => acc + val, 0);
                        // Normalize the data
                        return data.map(val => (val / sum) * 100);
                    };


                    const normalizedSeverityeries = normalizeData(Severityeries);
                    const normalizedSevenDaysSeries = normalizeData(sevenDaysSeries);
                    const normalizedThirtyDaysSeries = normalizeData(thirtyDaysSeries);
                    const normalizedseverityDistributionSeries = normalizeData(severityDistributionSeries);

                    const severityColorMapping = {
                        'Minimal or none': '#4361ee',
                        'Moderate': '#805dca',
                        'Mild': '#00ab55',
                        'Severe': '#e7515a',
                        'Moderately severe': '#ffd700', 
                    };                   
                    // severity Pie Chart
                    const severityPieOptions = {
                        series: normalizedSeverityeries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: severityLabels,
                        colors: severityLabels.map(label => severityColorMapping[label] || '#000000'), // Use the color mapping 
                        legend: {
                            position: 'bottom',
                        },

                    };


                    this.severityPieChart = new ApexCharts(this.$refs.severityPieChart, severityPieOptions);
                    this.severityPieChart.render();

                    // Seven Days Chart
                    const sevenDaysOptions = {
                        series: normalizedSevenDaysSeries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: sevenDaysLabels,
                        colors: severityLabels.map(label => severityColorMapping[label] || '#000000'), // Use the color mapping 
                        legend: {
                            position: 'bottom',
                        }
                    };

                    this.sevenDaysChart = new ApexCharts(this.$refs.sevenDaysChart, sevenDaysOptions);
                    this.sevenDaysChart.render();

                    // Thirty Days Chart
                    const thirtyDaysOptions = {
                        series: normalizedThirtyDaysSeries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: thirtyDaysLabels,
                        colors: severityLabels.map(label => severityColorMapping[label] || '#000000'), // Use the color mapping 
                        legend: {
                            position: 'bottom',
                        }
                    };

                    this.thirtyDaysChart = new ApexCharts(this.$refs.thirtyDaysChart, thirtyDaysOptions);
                    this.thirtyDaysChart.render();



                    // Overall severity Pyramid Chart
                    const severityPyramidOptions = {
                        series: [{
                            name: "",
                            data: severityDistributionSeries, // Use your normalized data here
                        }],
                        chart: {
                            type: 'bar',
                            height: 530,
                        },
                        plotOptions: {
                            bar: {
                                borderRadius: 0,
                                horizontal: true,
                                distributed: true,
                                barHeight: '80%',
                                isFunnel: false,
                            },
                        },
                        colors: severityDistributionLabels.map(label => severityColorMapping[label] || '#000000'), // Use the color mapping 
                        dataLabels: {
                            enabled: true,
                            formatter: function (val, opt) {
                                return opt.w.globals.labels[opt.dataPointIndex];
                            },
                            dropShadow: {
                                enabled: true,
                            },
                        },

                        xaxis: {
                            categories: severityDistributionLabels,
                        },
                        legend: {
                            show: false,
                        },
                    };

                    this.severityPyramidChart = new ApexCharts(this.$refs.severityPyramidChart, severityPyramidOptions);
                    this.severityPyramidChart.render();

                },
            }));
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new simpleDatatables.DataTable('#SeverityTable');

        }
        );

        async function showAlert(logId) {
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
                        deleteLog(logId);
                    }

                });
        }

        async function deleteLog(logId) {
            const formData = new FormData();
            formData.append('delete_id', logId);

            try {
                const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                    method: 'POST',
                    body: formData
                });

                if (response.ok) {

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500); // Adjust the delay time as needed
                } else {

                    swalWithBootstrapButtons.fire('Error', 'Failed to delete', 'error');
                }
            } catch (error) {
                swalWithBootstrapButtons.fire('Error', 'An unexpected error occurred.', 'error');
            }
        }


    </script>


    <?php include '../footer-main.php'; ?>