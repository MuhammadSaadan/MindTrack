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

//MOOD


// Query for highest frequency overall
$queryOverallMood = "SELECT mood, COUNT(*) AS frequency FROM log_mood WHERE user_id = $userId GROUP BY mood ORDER BY frequency DESC LIMIT 1";
$resultOverallMood = $conn->query($queryOverallMood);

// Get the result
$highestFrequencyOverallMood = $resultOverallMood->fetch_assoc();

// Fetch mood data from the database
$moodQuery = "SELECT mood, COUNT(*) as count FROM log_mood WHERE user_id = $userId GROUP BY mood";
$moodResult = $conn->query($moodQuery);


// Query for overall mood distribution
$queryMoodDistribution = "SELECT mood, COUNT(*) AS frequency FROM log_mood WHERE user_id = $userId GROUP BY mood ORDER BY frequency DESC";
$resultMoodDistribution = $conn->query($queryMoodDistribution);

// Get the result
$moodDistributionData = $resultMoodDistribution->fetch_all(MYSQLI_ASSOC);

$log_moods = array();


//SYMPTOM

// Query for highest frequency overall
$queryOverallSymptom = "SELECT symptom, COUNT(*) AS frequency FROM log_symptoms WHERE user_id = $userId GROUP BY symptom ORDER BY frequency DESC LIMIT 1";
$resultOverallSymptom = $conn->query($queryOverallSymptom);

// Get the result
$highestFrequencyOverallSymptom = $resultOverallSymptom->fetch_assoc();

// Fetch symptom data from the database
$symptomQuery = "SELECT symptom, COUNT(*) as count FROM log_symptoms WHERE user_id = $userId GROUP BY symptom";
$symptomResult = $conn->query($symptomQuery);


// Query for overall symptom distribution
$querysymptomDistribution = "SELECT symptom, COUNT(*) AS frequency FROM log_symptoms WHERE user_id = $userId GROUP BY symptom ORDER BY frequency DESC";
$resultsymptomDistribution = $conn->query($querysymptomDistribution);

// Get the result
$symptomDistributionData = $resultsymptomDistribution->fetch_all(MYSQLI_ASSOC);

$log_Symptoms = array();



//SELFTEST
// Query for highest frequency overall
$queryOverallSeverity = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId GROUP BY severity ORDER BY frequency DESC LIMIT 1";
$resultOverallSeverity = $conn->query($queryOverallSeverity);

// Get the result
$highestFrequencyOverallSeverity = $resultOverallSeverity->fetch_assoc();


// Fetch severity data from the database
$severityQuery = "SELECT severity, COUNT(*) as count FROM ph9_question WHERE user_id = $userId GROUP BY severity";
$severityResult = $conn->query($severityQuery);


// Query for overall severity distribution
$queryseverityDistribution = "SELECT severity, COUNT(*) AS frequency FROM ph9_question WHERE user_id = $userId GROUP BY severity ORDER BY frequency DESC";
$resultseverityDistribution = $conn->query($queryseverityDistribution);

// Get the result
$severityDistributionData = $resultseverityDistribution->fetch_all(MYSQLI_ASSOC);

$ph9_question = array();


$highestFrequencyLabels = ["Mood", "Symptom", "Severity"];
$highestFrequencyData = [
    $highestFrequencyOverallMood['frequency'] ?? 0,
    $highestFrequencyOverallSymptom['frequency'] ?? 0,
    $highestFrequencyOverallSeverity['frequency'] ?? 0
];



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
            title: 'Mood Updated',
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
                title: 'Mood Updated',
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
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/reportMood/moodsReport.php"
            class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mental
            Health Report</a></li>

    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Moods
            Report</a>

    </li>


</ol>
<br>

<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Full report
        </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Below are the stats for your mental health status</p>
        <p class="lead">
            <button type="button" x-on:click="window.location.href='/mhealthInformation/moods.php'"
                class="btn btn-dark">Learn more...</button>
        </p>
    </div>

    <br>


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <!-- overall mood pie chart -->
        <div x-ref="moodPieChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall Mood</p>
            <div x-ref="moodPieChart" style="height: 300px;"></div>
        </div>


        <div x-ref="moodPyramidChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall Mood Chart</p>
            <div x-ref="moodPyramidChart" style="height: 300px;"></div>
        </div>



        <!-- overall symptom pie chart -->
        <div x-ref="symptomPieChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall symptom</p>
            <div x-ref="symptomPieChart" style="height: 300px;"></div>
        </div>


        <div x-ref="symptomPyramidChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall symptom Chart</p>
            <div x-ref="symptomPyramidChart" style="height: 300px;"></div>
        </div>

        <!-- overall severity pie chart -->
        <div x-ref="severityPieChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall severity</p>
            <div x-ref="severityPieChart" style="height: 300px;"></div>
        </div>

        <div x-ref="severityPyramidChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Overall severity Chart</p>
            <div x-ref="severityPyramidChart" style="height: 300px;"></div>
        </div>


    </div>


    <div id="highestFrequencyBarChart" class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Highest Frequency for Mood, Symptom, and Severity</p>
            <div style="height: 530px;"></div>
        </div>
    <!-- Include the required libraries -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- scripts -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("charts", () => ({
                moodPieChart: null,
                moodPyramidChart: null,
                symptomPieChart: null,
                symptomPyramidChart: null,
                severityPieChart: null,
                severityPyramidChart: null,
                highestFrequencyBarChart: null, 

                init() {
                    let isDark;

                    // Mood data
                    const moodData = <?php echo json_encode($moodResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const moodSeries = moodData.map(entry => entry.count);
                    const moodLabels = moodData.map(entry => entry.mood);


                    const moodDistributionData = <?php echo json_encode($moodDistributionData); ?>;
                    const moodDistributionLabels = moodDistributionData.map(entry => entry.mood);
                    const moodDistributionSeries = moodDistributionData.map(entry => entry.frequency);

                    // Symptom data
                    const symptomData = <?php echo json_encode($symptomResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const Symptomseries = symptomData.map(entry => entry.count);
                    const symptomLabels = symptomData.map(entry => entry.symptom);

                    const symptomDistributionData = <?php echo json_encode($symptomDistributionData); ?>;
                    const symptomDistributionLabels = symptomDistributionData.map(entry => entry.symptom);
                    const symptomDistributionSeries = symptomDistributionData.map(entry => entry.frequency);

                    // severity data
                    const severityData = <?php echo json_encode($severityResult->fetch_all(MYSQLI_ASSOC)); ?>;
                    const Severityeries = severityData.map(entry => entry.count);
                    const severityLabels = severityData.map(entry => entry.severity);

                    const severityDistributionData = <?php echo json_encode($severityDistributionData); ?>;
                    const severityDistributionLabels = severityDistributionData.map(entry => entry.severity);
                    const severityDistributionSeries = severityDistributionData.map(entry => entry.frequency);


                    const normalizeData = (data) => {
                        const sum = data.reduce((acc, val) => acc + val, 0);
                        // Normalize the data
                        return data.map(val => (val / sum) * 100);
                    };


                    const normalizedMoodSeries = normalizeData(moodSeries);
                    const normalizedSymptomseries = normalizeData(Symptomseries);
                    const normalizedSeverityeries = normalizeData(Severityeries);


                    // Mood Pie Chart
                    const moodPieOptions = {
                        series: normalizedMoodSeries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: moodLabels,
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                        legend: {
                            position: 'bottom',
                        },

                    };


                    this.moodPieChart = new ApexCharts(this.$refs.moodPieChart, moodPieOptions);
                    this.moodPieChart.render();


                    // Overall Mood Pyramid Chart
                    const moodPyramidOptions = {
                        series: [{
                            name: "",
                            data: moodDistributionSeries, // Use your normalized data here
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
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
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
                            categories: moodDistributionLabels,
                        },
                        legend: {
                            show: false,
                        },
                    };

                    this.moodPyramidChart = new ApexCharts(this.$refs.moodPyramidChart, moodPyramidOptions);
                    this.moodPyramidChart.render();


                    // symptom Pie Chart
                    const symptomPieOptions = {
                        series: normalizedSymptomseries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: symptomLabels,
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                        legend: {
                            position: 'bottom',
                        },

                    };


                    this.symptomPieChart = new ApexCharts(this.$refs.symptomPieChart, symptomPieOptions);
                    this.symptomPieChart.render();


                    // Overall symptom Pyramid Chart
                    const symptomPyramidOptions = {
                        series: [{
                            name: "",
                            data: symptomDistributionSeries, // Use your normalized data here
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
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
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
                            categories: symptomDistributionLabels,
                        },
                        legend: {
                            show: false,
                        },
                    };

                    this.symptomPyramidChart = new ApexCharts(this.$refs.symptomPyramidChart, symptomPyramidOptions);
                    this.symptomPyramidChart.render();


                    // severity Pie Chart
                    const severityPieOptions = {
                        series: normalizedSeverityeries,
                        chart: {
                            type: 'pie',
                            height: 530,
                        },
                        labels: severityLabels,
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                        legend: {
                            position: 'bottom',
                        },

                    };

                    this.severityPieChart = new ApexCharts(this.$refs.severityPieChart, severityPieOptions);
                    this.severityPieChart.render();

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
                        colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
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

                    const highestFrequencyBarOptions = {
                        series: [{
                            data: <?= json_encode($highestFrequencyData); ?>,
                        }],
                        chart: {
                            type: 'bar',
                            height: 530,
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                            },
                        },
                        xaxis: {
                            categories: <?= json_encode($highestFrequencyLabels); ?>,
                        },
                        colors: ['#4361ee'], // Choose your desired color
                    };

                    this.highestFrequencyBarChart = new ApexCharts(document.querySelector("#highestFrequencyBarChart"), highestFrequencyBarOptions);
                    this.highestFrequencyBarChart.render();

                },
            }));
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new simpleDatatables.DataTable('#moodsTable');

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