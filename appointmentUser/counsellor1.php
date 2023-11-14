<?php
require '../config.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];

    if (empty($name) || empty($phone_number) || empty($date)) {
        echo "All fields are required.";
    } else {
        // Store data in session for use in the next page
        $_SESSION['name'] = $name;
        $_SESSION['phone_number'] = $phone_number;
        $_SESSION['date'] = $date;
        $_SESSION['selectedCounsellor'] = 'Dr.Aishah Rahman';
        $_SESSION['status'] = 'Pending';

        // Redirect to the next page
        header("Location: counsellor2.php");
        exit();
    }
}

include '../header-main.php';

?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="logsymptoms">
    <!-- arrowed -->
    <ol class="flex text-primary font-semibold dark:text-white-dark">
        <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
                class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
        </li>
        <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
                class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Symptom
                Monitoring</a></li>

    </ol>
    <br>

    <div x-data="charts">

        <br>
        <div class="flex justify-center items-center h-screen">

            <div class="panel" style="width: 50rem;">

                <form method="post" action="/appointmentUser/counsellor1.php" id="logcounsellor1">

                    <div class="mb-5">
                        <label for="name">Name :</label>
                        <input id="name" type="text" name="name" class="form-input" required />
                        <div class="text-danger mt-2" id="name"></div>
                    </div>

                    <div class="mb-5">
                        <label for="phone_number">Contact No :</label>
                        <input id="phone_number" type="tel" name="phone_number" class="form-input" required />
                        <div class="text-danger mt-2" id="phone_number"></div>
                    </div>


                    <div class="mb-5">
                        <label for="date">Date :</label>
                        <input id="date" type="date" name="date" class="form-input" />
                        <div class="text-danger mt-2" id="startDateErr"></div>
                    </div>

                   


                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn btn-primary">Next</button>

                        </div>


                </form>
            </div>
        </div>

    </div>


    <?php include '../footer-main.php'; ?>