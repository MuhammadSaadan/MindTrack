<?php

require '../config.php';


include '../header-main.php';

?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="moodtracking">


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
    </div>
    <br>


    <div class="flex justify-center">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
            <!-- card 1 -->
            <div
                class="max-w-[25rem] sm:max-w-[30rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr h-[215px] overflow-hidden">
                        <img src="/assets/images/aps1.jpeg" alt="image" class="w-full h-full object-cover"
                            style="object-position: 50% 10%; object-fit: cover;" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Dr. Aishah Rahman,
                        Ph.D., LMHC</h5>
                    <p class="text-white-dark" style="text-align: justify;">
                        Dr. Aishah Rahman is a highly skilled and empathetic mental health counselor with a Ph.D. in
                        counseling psychology. Fluent in English, Bahasa Malaysia, and Malay, she specializes in
                        culturally sensitive therapy for anxiety, depression, and family-related issues. Aisha's
                        approach integrates Islamic psychology and mindfulness techniques. Her warm and culturally
                        attuned counseling style creates a safe space for clients to explore their mental health
                        challenges.
                    </p>
                    <br>

                    <p><button type="button" onclick="window.location.href='/appointmentUser/counsellor1.php'"
                            class="btn btn-primary">Book an Appointment</button></p>

                </div>
            </div>


            <!-- card 2 -->


            <div
                class="max-w-[25rem] sm:max-w-[30rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr h-[215px] overflow-hidden">
                        <img src="/assets/images/aps3.jpg" alt="image" class="w-full h-full object-cover"
                            style="object-position: 50% 10%; object-fit: cover;" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Priya Devi, MSc, LPC
                    </h5>
                    <p class="text-white-dark" style="text-align: justify;">
                        Priya Devi, a compassionate and dedicated licensed professional counselor, brings her expertise
                        in holistic well-being and mindfulness practices. Fluent in English, Tamil, and Malay, Priya
                        supports individuals dealing with stress, trauma, and cultural adjustment. She incorporates
                        elements of Indian psychology and meditation into her sessions, offering a nurturing environment
                        for the Malaysian Indian community to explore their mental health concerns.
                    </p>
                    <br>
                    </p>

                    <p><button type="button" onclick="window.location.href='/appointmentUser/counsellor2.php'"
                            class="btn btn-primary">Book an Appointment</button></p>
                </div>
            </div>



            <!-- card 3 -->


            <div
                class="max-w-[25rem] sm:max-w-[30rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr h-[215px] overflow-hidden">
                        <img src="/assets/images/aps2.jpg" alt="image" class="w-full h-full object-cover"
                            style="object-position: 50% 10%; object-fit: cover;" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Chen Wei Ming, MA, LMHC
                    </h5>
                    <p class="text-white-dark" style="text-align: justify;">
                        Chen Wei Ming, a dedicated Chinese male counselor, holds a master's degree in counseling
                        psychology. Fluent in Mandarin, Cantonese, and English, he specializes in stress management,
                        relationship issues, and career counseling. Chen incorporates traditional Chinese wellness
                        practices and modern psychological approaches, providing a culturally relevant perspective. His
                        supportive and holistic counseling style encourages personal growth and resilience.
                    </p>
                    <br>

                    <p><button type="button" onclick="window.location.href='/appointmentUser/counsellor3.php'"
                            class="btn btn-primary">Book an Appointment</button></p>
                </div>
            </div>


            <!-- card 4 -->


            <div
                class="max-w-[25rem] sm:max-w-[30rem] w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 -mx-6 rounded-tl rounded-tr h-[215px] overflow-hidden">
                        <img src="/assets/images/aps4.jpg" alt="image" class="w-full h-full object-cover"
                            style="object-position: 50% 10%; object-fit: cover;" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Lin Mei Ling, MEd, LMHC
                    </h5>
                    <p class="text-white-dark" style="text-align: justify;">
                        Dr. Aisha Rahman is a highly skilled and empathetic mental health counselor with a Ph.D. in
                        counseling psychology. Fluent in English, Bahasa Malaysia, and Malay, she specializes in
                        culturally sensitive therapy for anxiety, depression, and family-related issues. Aisha's
                        approach integrates Islamic psychology and mindfulness techniques. Her warm and culturally
                        attuned counseling style creates a safe space for clients to explore their mental health
                        challenges.
                    </p>
                    <br>

                    <p><button type="button" onclick="window.location.href='/appointmentUser/counsellor4.php'"
                            class="btn btn-primary">Book an Appointment</button></p>
                </div>
            </div>


        </div>
    </div>


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
    <?php include '../footer-main.php'; ?>