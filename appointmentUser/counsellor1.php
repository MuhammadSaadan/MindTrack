<?php
session_start();
include '../header-main.php';
include '../connect.php';

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Additional fields for dynamic values
    $selectedCounsellor = 'Dr.Aishah Rahman';
    $status = 'Pending';

    // Perform basic validation
    if (empty($user_id) || empty($name) || empty($phone_number) || empty($date) || empty($time)) {
        echo "All fields are required.";
    } else {
        // Prepared statement to prevent SQL injection
        $sql = "INSERT INTO appointments (user_id, name, phone_number, counsellor, status, date, time) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("issssss", $user_id, $name, $phone_number, $selectedCounsellor, $status, $date, $time);
            if ($stmt->execute()) {
                // Notification handling with SweetAlert2 in green color directly in JavaScript
                echo "<script defer src='/assets/js/apexcharts.js'></script>";
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
                echo "<script>
                        coloredToast = () => {
                            const toast = window.Swal.mixin({
                                toast: true,
                                position: 'bottom-start',
                                showConfirmButton: false,
                                timer: 3000,
                                showCloseButton: true,
                                customClass: {
                                    popup: 'background-color: #5cb85c; color: white; border-radius: 5px;' // Inline styles for green color
                                }
                            });
                            toast.fire({
                                title: 'Appointment Booked Successfully',
                                icon: 'success'
                            });
                        };
                        coloredToast();
                    </script>";
            } else {
                echo "Error logging mood."; // Handle any errors in execution
            }
        } else {
            echo "Prepared statement error."; // Handle any errors in prepared statement
        }

        $stmt->close(); // Close the prepared statement

        $conn->close(); // Close the database connection
    }
}
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

                    <div class="mb-5">


                        <div>
                            <label for="time">Time:</label>
                            <select name="time" id="ctnSelect1" class="form-select text-white-dark" required>
                                <option>10:00 AM</option>
                                <option>11:00 AM</option>
                                <option>12:00 PM</option>
                                <option>1:00 PM</option>
                                <option>2:00 PM</option>
                                <option>3:00 PM</option>
                                <option>4:00 PM</option>
                                <option>5:00 PM</option>
                                <option>6:00 PM</option>
                            </select>
                        </div>
                    </div>



                    <div style="display: flex; gap: 10px;">
                        <!-- Your form fields -->
                        <button type="submit" class="btn btn-primary">Book Appointment</button>

                    </div>


                </form>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




    <?php include '../footer-main.php'; ?>