<?php

require '../config.php';
include '../header-main.php';



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
}

// Fetch mood data from the database
$moodQuery = "SELECT mood, COUNT(*) as count FROM log_mood WHERE user_id = $userId GROUP BY mood";
$moodResult = $conn->query($moodQuery);

// Fetch symptom data from the database
$symptomQuery = "SELECT symptom, COUNT(*) as count FROM log_symptoms WHERE user_id = $userId GROUP BY symptom";
$symptomResult = $conn->query($symptomQuery);
?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Dashboard</a>
    </li>

</ol>
<br>

<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Hello,
            <?php echo $userName; ?>
        </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Welcome To Mindtrack!</p>
        <p class="lead">
            <button type="button" x-on:click="window.location.href='/mhealthInformation/list.php'"
                class="btn btn-dark">Learn more...</button>
        </p>
    </div>

    <br>
    <div class="panel">


<!-- justify pills -->
<div class="mb-5" x-data="{tab : 'home'}">
    <!-- buttons -->
    <div>
        <ul class="flex flex-wrap justify-between mt-3 space-x-2 rtl:space-x-reverse">
            <li class="flex-auto text-center">
                <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                    :class="{'bg-info text-white' : tab === 'home'}" @click="tab = 'home'">Purpose</a>
            </li>
            <li class="flex-auto text-center">
                <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                    :class="{'bg-info text-white' : tab === 'profile'}" @click="tab = 'aim'">Aim</a>
            </li>
            <li class="flex-auto text-center">
                <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                    :class="{'bg-info text-white' : tab === 'contact'}" @click="tab = 'objective'">Objective</a>
            </li>
        </ul>
    </div>

    <!-- description -->
    <div class="pt-5 flex-1 text-sm">
        <template x-if="tab === 'home'">
            <div>
                <h4 class="font-semibold text-2xl mb-4">Purpose of Mindtrack</h4>
                <p class="mb-4">
                    Mind Track is an innovative web application that helps you take charge of your mental
                    well-being. In a world where mental health issues are on the rise, Mind Track serves as your
                    personalized companion, offering a user-friendly platform to monitor, understand, and manage
                    your mental health.
                </p>
                <p class="mb-4">
                    This application is designed for everyone, regardless of age, background, or location. It's a
                    tool that empowers you to track your daily moods, monitor mental health symptoms, and even
                    assess your mental health using reliable tests. With easy-to-understand visualizations, you can
                    gain insights into your emotional patterns and progress over time.
                </p>
                <p class="mb-4">

                    In essence, Mind Track is not just an application; it's a companion on your mental health
                    journey.
                    It aims to reduce the stigma associated with seeking help, encourage open conversations, and
                    contribute to an overall improvement in mental health outcomes. With Mind Track, you have a
                    comprehensive and user-friendly tool to navigate the complexities of mental well-being, ensuring
                    that support is just a click away.
                </p>

            </div>
        </template>
        <template x-if="tab === 'aim'">
            <div>
                <h4 class="font-semibold text-2xl mb-4">Aim of Mindtrack</h4>
                <p class="mb-4">Mind Track aims to revolutionize mental health management by creating a
                    user-friendly web application that goes beyond traditional approaches. The goal is to break down
                    barriers to mental health support, offering a cost-effective and convenient solution that
                    encourages individuals to seek professional help when needed. The application aspires to
                    contribute to reducing the stigma associated with mental health disorders and create a
                    supportive environment for users. </p>

            </div>
        </template>
        <template x-if="tab === 'objective'">
            <div>
                <h4 class="font-semibold text-2xl mb-4">Objective</h4>
                <h5 class="font-semibold text-1xl mb-1">
                    Enhance Accessibility:
                </h5>
                <p>
                    Provide a platform that can be easily accessed by individuals of all ages, backgrounds, and
                    geographical locations, including those in rural or remote areas.
                </p>
                <br>
                <h5 class="font-semibold text-1xl mb-1">
                    Personalized Mental Health Management:
                </h5>
                <p>
                    Create tools that allow users to personalize their mental health management journey, identifying
                    patterns, tracking progress, and assessing the effectiveness of different treatments.
                    Address
                </p>
                <br>
                <h5 class="font-semibold text-1xl mb-1">
                    Financial Barriers:
                </h5>

                <p> Indirectly contribute to reducing the economic burden of mental health disorders by offering a
                    cost-effective alternative to traditional mental health services.
                </p>
                <br>
                <h5 class="font-semibold text-1xl mb-1">
                    Combat Stigmatization:
                </h5>
                <p>
                    Foster an environment that encourages openness about mental health concerns, reducing the stigma
                    associated with seeking help and promoting mental health awareness.
                </p>
                <br>
                <h5 class="font-semibold text-1xl mb-1">
                    Educate and Inform:
                </h5>
                <p>
                    Provide a rich resource of mental health information to educate users about various mental
                    health conditions, empowering them to make informed decisions about their well-being.
                </p>
            </div>
        </template>
    </div>
</div>

</div>
<div x-data="carousel">
<ul
    class="relative py-12 before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:bottom-0 before:left-1/2 before:top-0 before:w-[3px] before:-ml-[1.5px] max-w-[900px] mx-auto table">
    <li class="relative mb-12 before:clear-both before:table after:clear-both after:table">
        <div
            class="hidden sm:block absolute bg-info border-[3px] border-[#ebedf2] dark:border-[#191e3a] w-5 h-5 rounded-full left-1/2 top-[32px] -ml-2.5 z-[1]">
        </div>
        <div
            class="relative border border-[#ebedf2] dark:border-[#191e3a] max-w-[320px] mx-auto sm:max-w-full w-full sm:w-[46%] shadow-[0_20px_20px_rgba(126,142,177,0.12)] rounded-md bg-white dark:bg-[#191e3a] ltr:sm:float-left rtl:sm:float-right before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:w-[37px] before:h-[3px] before:rounded-full ltr:before:-right-[37px] rtl:before:-left-[37px] before:top-10 sm:before:block before:hidden">
            <div>
                <img src="/assets/images/clouds8.jpeg" alt="timeline" class="w-full rounded-t-md" />
            </div>
            <div class="p-5">
                <h4 class="mb-3 text-info text-lg font-semibold">Mood Tracking</h4>
                <p class="mb-3 text-white-dark"> Stay in tune with your emotions each day by tracking how you feel.
                    It's
                    an easy way to understand your mood changes over time.</p>
                <p><button type="button" onclick="window.location.href='/moodTracking/index.php'"
                        class="btn btn-info">Try me</button></p>
            </div>
        </div>
    </li>
    <li class="relative mb-12 before:clear-both before:table after:clear-both after:table">
        <div
            class="hidden sm:block absolute bg-primary border-[3px] border-[#ebedf2] dark:border-[#191e3a] w-5 h-5 rounded-full left-1/2 top-[32px] -ml-2.5 z-[1]">
        </div>
        <div
            class="relative border border-[#ebedf2] dark:border-[#191e3a] max-w-[320px] mx-auto sm:max-w-full w-full sm:w-[46%] shadow-[0_20px_20px_rgba(126,142,177,0.12)] rounded-md bg-white dark:bg-[#191e3a] ltr:sm:float-right rtl:sm:float-left before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:w-[37px] before:h-[3px] before:rounded-full  ltr:before:-left-[37px] rtl:before:-right-[37px] before:top-10 sm:before:block before:hidden">
            <div>
                <img src="/assets/images/clouds2.jpg" alt="timeline" class="w-full rounded-t-md" />
            </div>
            <div class="p-5">
                <h4 class="mb-3 text-primary text-lg font-semibold">Symptom Monitoring</h4>
                <p class="mb-3 text-white-dark">Take a daily check on how you're feeling physically and emotionally.
                    This simple routine helps you stay on top of your health.</p>
                <p><button type="button" onclick="window.location.href='/symptomMonitoring/index.php'"
                        class="btn btn-primary">Try me</button></p>
            </div>
        </div>
    </li>
    <li class="relative mb-12 before:clear-both before:table after:clear-both after:table">
        <div
            class="hidden sm:block absolute bg-success border-[3px] border-[#ebedf2] dark:border-[#191e3a] w-5 h-5 rounded-full left-1/2 top-[32px] -ml-2.5 z-[1]">
        </div>
        <div
            class="relative border border-[#ebedf2] dark:border-[#191e3a] max-w-[320px] mx-auto sm:max-w-full w-full sm:w-[46%] shadow-[0_20px_20px_rgba(126,142,177,0.12)] rounded-md bg-white dark:bg-[#191e3a] ltr:sm:float-left rtl:sm:float-right before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:w-[37px] before:h-[3px] before:rounded-full ltr:before:-right-[37px] rtl:before:-left-[37px] before:top-10 sm:before:block before:hidden">
            <div>
                <img src="/assets/images/clouds1.jpg" alt="timeline" class="w-full rounded-t-md" />
            </div>
            <div class="p-5">
                <h4 class="mb-3 text-success text-lg font-semibold">PH9 Questionnaire</h4>
                <p class="mb-3 text-white-dark">Evaluate your depression severity level accurately through our PH9
                    Questionnaire, a sophisticated tool designed to provide a nuanced analysis of your emotional
                    state.
                </p>
                <p><button type="button" onclick="window.location.href='/selfTest/index.php'"
                        class="btn btn-success">Try me</button></p>
            </div>
        </div>
    </li>
    <li class="relative mb-12 before:clear-both before:table after:clear-both after:table">
        <div
            class="hidden sm:block absolute bg-danger border-[3px] border-[#ebedf2] dark:border-[#191e3a] w-5 h-5 rounded-full left-1/2 top-[32px] -ml-2.5 z-[1]">
        </div>
        <div
            class="relative border border-[#ebedf2] dark:border-[#191e3a] max-w-[320px] mx-auto sm:max-w-full w-full sm:w-[46%] shadow-[0_20px_20px_rgba(126,142,177,0.12)] rounded-md bg-white dark:bg-[#191e3a] ltr:sm:float-right rtl:sm:float-left before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:w-[37px] before:h-[3px] before:rounded-full  ltr:before:-left-[37px] rtl:before:-right-[37px] before:top-10 sm:before:block before:hidden">
            <div>
                <img src="/assets/images/clouds7.jpeg" alt="timeline" class="w-full rounded-t-md" />
            </div>
            <div class="p-5">
                <h4 class="mb-3 text-danger text-lg font-semibold">Book an Appoinment</h4>
                <p class="mb-3 text-white-dark">Initiate meaningful progress by scheduling a consultation with our
                    seasoned counselors. Benefit from their expertise as you navigate your path toward emotional
                    resilience and well-being. </p>
                <p><button type="button" onclick="window.location.href='/appointmentUser/index.php'"
                        class="btn btn-danger">Try me</button></p>
            </div>
        </div>
    </li>
    <li class="relative mb-12 before:clear-both before:table after:clear-both after:table">
        <div
            class="hidden sm:block absolute bg-success border-[3px] border-[#ebedf2] dark:border-[#191e3a] w-5 h-5 rounded-full left-1/2 top-[32px] -ml-2.5 z-[1]">
        </div>
        <div
            class="relative border border-[#ebedf2] dark:border-[#191e3a] max-w-[320px] mx-auto sm:max-w-full w-full sm:w-[46%] shadow-[0_20px_20px_rgba(126,142,177,0.12)] rounded-md bg-white dark:bg-[#191e3a] ltr:sm:float-left rtl:sm:float-right before:absolute before:bg-[#ebedf2] dark:before:bg-[#191e3a] before:w-[37px] before:h-[3px] before:rounded-full ltr:before:-right-[37px] rtl:before:-left-[37px] before:top-10 sm:before:block before:hidden">
            <div>
                <img src="/assets/images/clouds4.jpg" alt="timeline" class="w-full rounded-t-md" />
            </div>
            <div class="p-5">
                <h4 class="mb-3 text-success text-lg font-semibold">Mental Health Report</h4>
                <p class="mb-3 text-white-dark">Assess your mental health statusby looking at a visual summary of
                    all your mental health tracking.
                </p>
                <p><button type="button" onclick="window.location.href='/dashboardUser/dashboard.php'"
                        class="btn btn-primary">Try me</button></p>
            </div>
        </div>
    </li>
</ul>



</div>
</div>
</div>

<!-- start hightlight js -->
<link rel="stylesheet" href="/assets/css/highlight.min.css">
<script src="/assets/js/highlight.min.js"></script>
<!-- end hightlight js -->



<script>
document.addEventListener("alpine:init", () => {
    Alpine.data("carousel", () => ({
        items: ['carousel1.jpeg', 'carousel2.jpeg', 'carousel3.jpeg'],

        init() {

            // Loop
            const swiper4 = new Swiper("#slider4", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    type: "fraction",
                },
                navigation: {
                    nextEl: '.swiper-button-next-ex4',
                    prevEl: '.swiper-button-prev-ex4',
                },
            });

        },

        // highlightjs
        codeArr: [],
        toggleCode(name) {
            if (this.codeArr.includes(name)) {
                this.codeArr = this.codeArr.filter((d) => d != name);
            } else {
                this.codeArr.push(name);

                setTimeout(() => {
                    document.querySelectorAll('pre.code').forEach(el => {
                        hljs.highlightElement(el);
                    });
                });
            }
        }
    }));
});
</script>

    <?php include '../footer-main.php'; ?>