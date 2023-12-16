<?php
// Include your configuration file and header
require '../config.php';


// Fetch counselors from the database
$sql = "SELECT * FROM counselors";
$result = $conn->query($sql);

include '../header-main.php';

?>

<!-- arrowed -->
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Appointment
        </a></li>

</ol>
<br>

<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-6 py-10 sm:px-10 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
        <h2 class="text-4xl md:text-5xl mb-4 mt-6 text-center dark:text-white-light">Book an Appointment</h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="text-center text-lg text-gray-600 dark:text-gray-400"> Schedule a consultation with our seasoned
            counselors</p>

        <p class="lead">
            <button type="button" x-on:click="window.location.href='/appointmentUser/view2.php'"
                class="btn btn-dark">View Booked Appointments</button>
        </p>
    </div>
    <br>


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
        <?php
        // Loop through the counselors and generate a card for each
        while ($row = $result->fetch_assoc()) {
            ?>
            <div
                class="max-w-[25rem] sm:max-w-[30rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr h-[215px] overflow-hidden">
                        <img src="<?php echo $row['picture_path']; ?>" alt="Counselor Image"
                            class="w-full h-full object-cover" style="object-position: 50% 10%; object-fit: cover;" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">
                        <?php echo $row['name']; ?>
                    </h5>
                    <p class="text-white-dark" style="text-align: justify;">
                        <?php echo $row['description']; ?>
                    </p>
                    <br>
                    <p><button type="button"
                            onclick="window.location.href='/appointmentUser/counsellor.php?id=<?php echo $row['id']; ?>'"
                            class="btn btn-primary">Book an Appointment</button>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</div>
<br>

<script>
    // Add an event listener to the "Book An Appointment" buttons
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.btn.btn-primary'); // Select all buttons with the "Book An Appointment" class

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const form = document.querySelector('.fixed'); // Select the form modal by its class

                // Toggle the visibility of the form modal
                form.classList.toggle('hidden');
            });
        });
    });
</script>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("modal", (initialOpenState = false) => ({
            open: initialOpenState,

            toggle() {
                this.open = !this.open;
            },
        }));
    });
</script>
<?php include '../footer-main.php'; ?>