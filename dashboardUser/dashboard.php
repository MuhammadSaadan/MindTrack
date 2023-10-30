<?php
session_start();
include '../header-main.php';

$welcomeMessage = 'User Dashboard';

if (isset($_SESSION['user_id']) && isset($_SESSION['user_type'])) {
    $userType = $_SESSION['user_type'];
}
?>

<!-- Your HTML and PHP content -->

<ul class="flex space-x-2 rtl:space-x-reverse">
    <li>
        <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
    </li>
    <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
        <span><?php echo $welcomeMessage; ?></span>
    </li>
</ul>

<div x-data="charts">
    <div class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Hello, </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Below are your stats for your mental health.</p>
        <p class="lead"><button type="button" a href="your_learn_more_page_url" class="btn btn-dark">Learn more...</button></p>
    </div>
    

    <div class="grid grid-cols-1 gap-10">
        <div class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Your Frequent Moods</p>
            <div x-ref="moodPieChart" style="height: 300px;"></div> <!-- Added height to container -->
        </div>

        
        <div class="bg-white dark:bg-black rounded-lg">
            <p class="lead mt-4 text-center text-lg text-gray-600 dark:text-gray-400">Your Frequent Symptoms</p>
            <div x-ref="symptomPieChart" style="height: 300px;"></div> <!-- Added height to container -->
        </div>
    </div>

    <div x-ref="areaChart" class="bg-white dark:bg-black rounded-lg mt-5" style="height: 50vh;"></div>
</div>

<!-- scripts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("charts", () => ({
            moodPieChart: null,
            symptomPieChart: null,
            areaChart: null,
            init() {
                const moodPieOptions = {
                    series: [44, 55, 13, 43, 22],
                    chart: {
                        type: 'pie',
                        height: 620, // Set a specific pixel value for the height
                    },
                    labels: ['Happy', 'Sad', 'Angry', 'Anxious', 'Relaxed'],
                    colors: ['#4361ee', '#805dca', '#00ab55', '#e7515a', '#e2a03f'],
                    legend: {
                        position: 'bottom',
                    }
                };

                this.moodPieChart = new ApexCharts(this.$refs.moodPieChart, moodPieOptions);
                this.moodPieChart.render();

                const symptomPieOptions = {
                    series: [20, 30, 10, 25, 15],
                    chart: {
                        type: 'pie',
                        height: 620, // Set a specific pixel value for the height
                    },
                    labels: ['Headache', 'Fatigue', 'Nausea', 'Anxiety', 'Insomnia'],
                    colors: ['#f94a9b', '#5f76e8', '#36a2ac', '#ff822b', '#e458a0'],
                    legend: {
                        position: 'bottom',
                    }
                };

                this.symptomPieChart = new ApexCharts(this.$refs.symptomPieChart, symptomPieOptions);
                this.symptomPieChart.render();

                const areaOptions = {
                    series: [{
                        name: 'Income',
                        data: [16800, 16800, 15500, 17800, 15500, 17000, 19000, 16000, 15000, 17000, 14000, 17000]
                    }],
                    chart: {
                        type: 'area',
                        height: 650,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#805dca'],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    }
                };

                this.areaChart = new ApexCharts(this.$refs.areaChart, areaOptions);
                this.areaChart.render();
            }
        }));
    });
</script>

<?php include '../footer-main.php'; ?>