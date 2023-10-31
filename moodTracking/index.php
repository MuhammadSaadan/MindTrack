<?php 

session_start();

include '../header-main.php'; ?>


<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="moodtracking">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] before:mr-1 rtl:before:ml-1">
            <span>Mood Tracking</span>
        </li>
    </ul>


    <div x-data="charts">
    <div class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Mental Health Information </h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400"></p>
    
    </div>
</div>

            
<?php include '../footer-main.php'; ?>
