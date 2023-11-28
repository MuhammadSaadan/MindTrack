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
                class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Symptoms</a>
        </li>

    </ol>
    <br>


    <div x-data="charts">
        <div
            class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
            <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Symptoms</h2>
            <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Describes the symptoms that is
                used
                to track your Mental Health Well-Being</p>

            <hr class="my-4 dark:border-[#191e3a]">
            <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400"></p>

        </div>
    </div>

    <br>

    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Headache -->

        <div class="panel">

            <div class="flex items-center space-x-4">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle opacity="0.5" cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5" />
                    <path
                        d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13"
                        stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" />
                    <circle cx="12" cy="16" r="1" fill="#1C274C" />
                </svg>
                <h5 class="text-lg text-gray-600 dark:text-gray-400">For symptoms, we chose things like headaches,
                    fatigue, nausea, anxiety, and insomnia. These represent both physical and emotional aspects that can
                    affect mental health. By paying attention to these symptoms, users can learn more about how their
                    emotions and physical well-being are connected, making it easier to take care of themselves.
                </h5>
            </div>

        </div>

        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Headache</h5>

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
                                <p>Physical symptom often associated with stress, tension, or other factors, resulting
                                    in pain or discomfort in the head region.
                                    Fatigue:</p>
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
                                    <p>Stress, dehydration, lack of sleep, eye strain.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fatigue -->
        <div class="panel">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">Fatigue</h5>

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
                                <p>Reflects physical and mental tiredness, indicating a sense of weariness, reduced
                                    energy levels, and the need for rest or recuperation.</p>
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
                                    <p> Poor sleep, overexertion, stress, certain medications.</p>
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
                <h5 class="font-semibold text-lg dark:text-white-light">Nausea</h5>

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
                                <p>Represents a physical manifestation of emotional distress, characterized by a
                                    sensation of queasiness or discomfort in the stomach, often linked to heightened
                                    stress or anxiety.</p>
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
                                    <p>Anxiety, strong emotions, motion sickness, certain foods.</p>
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
                <h5 class="font-semibold text-lg dark:text-white-light">Anxiety</h5>

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
                                <p>Addresses the emotional aspect of anxiety, a complex emotional state involving
                                    excessive worry, fear, or apprehension, which may impact daily functioning and
                                    well-being.</p>
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
                                    <p>Uncertainty, major life changes, social situations, past traumas.</p>
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
            <h5 class="font-semibold text-lg dark:text-white-light">Insomnia</h5>

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
                            <p>Indicates difficulty in sleeping, encompassing challenges in falling asleep, staying
                                asleep, or experiencing restorative sleep, often linked to various factors such as
                                stress, anxiety, or disrupted sleep patterns.</p>
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
                                <p>
                                    Stress, irregular sleep patterns, caffeine or stimulant intake, anxiety.</p>
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