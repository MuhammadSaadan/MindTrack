<?php

session_start();

include '../header-main.php'; ?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="moodtracking">
    <ol class="flex text-primary font-semibold dark:text-white-dark">
        <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href=""
                class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mind
                Resources</a></li>
        <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
                class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Moods</a>
        </li>

    </ol>
    <br>


    <div x-data="charts">
        <div
            class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
            <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Moods</h2>
            <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Describes the moods that is used
                to track your Mental Health Well-Being</p>

            <hr class="my-4 dark:border-[#191e3a]">
            <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400"></p>

        </div>
    </div>

    <br>

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Happy -->


        <div class="panel">

            <div class="flex items-center space-x-4">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle opacity="0.5" cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5" />
                    <path
                        d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13"
                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                    <circle cx="12" cy="16" r="1" fill="#1C274C" />
                </svg>
                <h5 class="text-lg text-gray-600 dark:text-gray-400">We picked moods that include a wide range of
                    feelings such as happy, sad, angry, anxious, and relaxed. This way, users can express and keep track
                    of
                    how they're feeling emotionally, helping them understand and manage their well-being better.
                </h5>
            </div>

        </div>

        
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Happy</h5>

            </div>
            <div class="mb-5" x-data="{ active: 1 }">
                <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                    <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                        <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{'!text-primary' : active === 1}"
                            x-on:click="active === 1 ? active = null : active = 1">Definition
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <div x-cloak x-show="active === 1" x-collapse>
                            <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                <p>Represents a positive emotional state characterized by feelings of joy, contentment,
                                    and overall satisfaction with life.</p>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                                :class="{'!text-primary' : active === 3}"
                                x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>

                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Positive experiences, achievements, social connections, enjoyable activities.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- sad -->
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Sad</h5>

            </div>
            <div class="mb-5" x-data="{ active: 1 }">
                <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                    <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                        <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{'!text-primary' : active === 1}"
                            x-on:click="active === 1 ? active = null : active = 1">Definition
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <div x-cloak x-show="active === 1" x-collapse>
                            <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                <p>Acknowledges the presence of negative emotions such as unhappiness, sorrow, or
                                    melancholy, indicating a temporary or prolonged downturn in mood.</p>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                                :class="{'!text-primary' : active === 3}"
                                x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>

                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Loss, disappointment, stress, feeling isolated.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Angry -->
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Angry</h5>

            </div>
            <div class="mb-5" x-data="{ active: 1 }">
                <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                    <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                        <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{'!text-primary' : active === 1}"
                            x-on:click="active === 1 ? active = null : active = 1">Definition
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <div x-cloak x-show="active === 1" x-collapse>
                            <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                <p>Recognizes the natural occurrence of anger, an intense emotional response typically
                                    triggered by perceived threats, injustices, or frustrations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                                :class="{'!text-primary' : active === 3}"
                                x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>

                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Frustration, perceived injustice, conflicts, unmet expectations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- anxious -->
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Anxious</h5>

            </div>
            <div class="mb-5" x-data="{ active: 1 }">
                <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                    <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                        <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{'!text-primary' : active === 1}"
                            x-on:click="active === 1 ? active = null : active = 1">Definition
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <div x-cloak x-show="active === 1" x-collapse>
                            <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                <p>Addresses feelings of anxiety, a state of heightened worry, nervousness, or unease
                                    often accompanied by physical sensations such as increased heart rate or muscle
                                    tension.</p>
                            </div>
                        </div>
                    </div>
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                                :class="{'!text-primary' : active === 3}"
                                x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>

                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Uncertainty, upcoming events, excessive workload, social situations.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Relaxed -->
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Relaxed</h5>

        </div>
        <div class="mb-5" x-data="{ active: 1 }">
            <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                    <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                        :class="{'!text-primary' : active === 1}"
                        x-on:click="active === 1 ? active = null : active = 1">Definition
                        <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </button>
                    <div x-cloak x-show="active === 1" x-collapse>
                        <div class="space-y-2 p-4 text-white-dark text-[13px]">
                            <p>Celebrates moments of relaxation and calmness, reflecting a state of reduced stress,
                                tension, and a general sense of ease.</p>
                        </div>
                    </div>
                </div>
                <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                    <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                        <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]"
                            :class="{'!text-primary' : active === 3}"
                            x-on:click="active === 3 ? active = null : active = 3">Triggers
                            <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                    <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </button>
                        <div x-cloak x-show="active === 3" x-collapse>

                            <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                <p>Leisure activities, meditation, downtime, positive environments.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- script -->
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("collapse", () => ({
                collapse: false,

                collapseSidebar() {
                    this.collapse = !this.collapse;
                },
            }));

            Alpine.data("dropdown", (initialOpenState = false) => ({
                open: initialOpenState,

                toggle() {
                    this.open = !this.open;
                },
            }));
        });
    </script>

    <style>
        .accordion-container {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
    </style>
    <?php include '../footer-main.php'; ?>