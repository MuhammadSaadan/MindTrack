<?php 

session_start();

include '../header-main.php'; ?>

<script defer src="/assets/js/apexcharts.js"></script>
<div x-data="moodtracking">
<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="" class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mind Resources</a></li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Mental Disorders</a></li>

</ol>
<br>


    <div x-data="charts">
    <div class="prose bg-[#f1f2f3] px-4 py-9 sm:px-8 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light ">
        <h2 class="text-dark mb-5 mt-4 text-center text-5xl dark:text-white-light">Mental Disorders</h2>
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400">Learn the different types of Mental Disorders.</p>

        <hr class="my-4 dark:border-[#191e3a]">
        <p class="lead my-5 text-center text-lg text-gray-600 dark:text-gray-400"></p>
    
    </div>
</div>

<br>

 <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Anxiety Disorder -->
      <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Anxiety Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Anxiety Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Anxiety disorders are a group of mental health conditions characterized by excessive worry, fear, or anxiety. Generalized Anxiety Disorder (GAD) involves persistent and excessive worrying about various aspects of life, while Panic Disorder leads to recurrent, unexpected panic attacks. Phobias are intense, irrational fears of specific objects or situations. Obsessive-Compulsive Disorder (OCD) involves intrusive thoughts (obsessions) leading to repetitive behaviors or mental acts (compulsions). Post-Traumatic Stress Disorder (PTSD) occurs after experiencing or witnessing a traumatic event.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Generalized Anxiety Disorder (GAD)</a></li>
                        <li>• Panic Disorder</a></li>
                        <li>• Phobias (e.g., Social Phobia, Specific Phobias)</a></li>
                        <li>• Obsessive-Compulsive Disorder (OCD)</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Triggers can be varied, including genetics, brain chemistry, life stressors, traumatic experiences, or environmental factors.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

      <!-- Mood Disorders -->
      <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Mood Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Mood Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Mood disorders involve disturbances in a person's emotional state. Major Depressive Disorder (MDD) is characterized by persistent feelings of sadness, hopelessness, or loss of interest in activities. Bipolar Disorder involves extreme mood swings, cycling between periods of high energy (mania) and low mood (depression). Cyclothymic Disorder consists of numerous periods of hypomanic symptoms and periods of depressive symptoms.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Major Depressive Disorder (MDD)</a></li>
                        <li>• Bipolar Disorder</a></li>
                        <li>• Cyclothymic Disorder</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Genetic predisposition, hormonal imbalances, life stressors, trauma, and environmental factors can contribute to the development of mood disorders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

  <!-- Schizo -->
  <div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Schizophrenia Spectrum and Other Psychotic Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Schizophernia?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Schizophrenia is a severe mental disorder characterized by disturbances in thinking, perceptions, emotions, and behavior. It often involves hallucinations, delusions, disorganized thinking, and social withdrawal. Schizoaffective Disorder combines symptoms of schizophrenia with mood disorders like mania or depression.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Schizophrenia</a></li>
                        <li>• Schizoaffective Disorder</a></li>
                        <li>• Delusional Disorder</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Genetic factors, prenatal stressors, brain chemistry imbalances, and environmental factors might contribute to the onset of schizophrenia.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<!-- Personality Disorders -->
<div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Personality Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Personality Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Personality disorders involve enduring patterns of behavior, cognition, and inner experience that deviate from societal expectations. Borderline Personality Disorder (BPD) includes unstable relationships, self-image, and emotions. Antisocial Personality Disorder involves a pattern of disregard for the rights of others. Narcissistic Personality Disorder consists of a grandiose sense of self-importance and a lack of empathy for others.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Borderline Personality Disorder (BPD)</a></li>
                        <li>• Antisocial Personality Disorder</a></li>
                        <li>• Narcissistic Personality Disorder</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Genetics, early life experiences, trauma, and environmental factors play a role in the development of personality disorders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<!-- Eating -->
<div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Eating Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Eating Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Eating disorders involve disturbances in eating behaviors and body image. Anorexia Nervosa is characterized by restricted food intake leading to significantly low body weight. Bulimia Nervosa involves binge eating followed by compensatory behaviors to avoid weight gain. Binge-Eating Disorder involves consuming large amounts of food without compensatory behaviors.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Anorexia Nervosa</a></li>
                        <li>• Bulimia Nervosa</a></li>
                        <li>• Binge-Eating Disorder</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Psychological, social, and biological factors, along with societal pressures related to body image and perfectionism, contribute to the onset of eating disorders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<!-- neuro Disorders -->
<div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Neurodevelopmental Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Neurodevelopmental Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>These disorders typically manifest in childhood and impact brain function and development. Attention-Deficit/Hyperactivity Disorder (ADHD) involves inattention, hyperactivity, and impulsivity. Autism Spectrum Disorder involves challenges in social communication and behavior. Intellectual Disability is characterized by limitations in intellectual functioning and adaptive behavior.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Attention-Deficit/Hyperactivity Disorder (ADHD)</a></li>
                        <li>• Autism Spectrum Disorder</a></li>
                        <li>• Intellectual Disability</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Genetic factors, brain development issues, environmental factors, prenatal conditions, and exposure to toxins might contribute to neurodevelopmental disorders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<!-- Trauma Disorders -->
<div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Trauma and Stressor-Related Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Trauma and Stressor-Related Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Acute stress disorder and adjustment disorders occur in response to stressful or traumatic events, causing significant distress and impairment in daily functioning.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Acute Stress Disorder</a></li>
                        <li>• Adjustment Disorders</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Traumatic events such as accidents, abuse, natural disasters, or major life changes can trigger these disorders.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
</div>

<!-- Dissociative Disorders -->
<div class="panel">
                <div class="flex items-center justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Dissociative Disorders</h5>
                    
                </div>
                <div class="mb-5" x-data="{ active: 1 }">
                    <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 1}" x-on:click="active === 1 ? active = null : active = 1">What is Anxiety Disorders?
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 1}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 1" x-collapse>
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>These disorders involve disruptions or breakdowns of memory, awareness, identity, or perception. Dissociative Identity Disorder (DID) involves the presence of two or more distinct personality states. Depersonalization/Derealization Disorder involves feeling detached from one's mind or body or feeling that the world is unreal or foggy.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 2}" x-on:click="active === 2 ? active = null : active = 2">Types
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 2}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 2" x-collapse>
                            <div class="p-4 text-[13px] border-t border-[#d3d3d3] dark:border-[#1b2e4b]">
                    <ul class="space-y-1">
                        <li>• Dissociative Identity Disorder (DID)</a></li>
                        <li>• Depersonalization/Derealization Disorder</a></li>
                    </ul>
                </div>
                            </div>
                        </div>
                        <div class="border border-[#d3d3d3] dark:border-[#3b3f5c] rounded font-semibold">
                        <div class="border-b border-[#d3d3d3] dark:border-[#3b3f5c]">
                            <button type="button" class="p-4 w-full flex items-center text-white-dark dark:bg-[#1b2e4b]" :class="{'!text-primary' : active === 3}" x-on:click="active === 3 ? active = null : active = 3">Triggers
                                <div class="ltr:ml-auto rtl:mr-auto" :class="{'rotate-180' : active === 3}">

                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                                        <path d="M19 9L12 15L5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </button>
                            <div x-cloak x-show="active === 3" x-collapse>
                                
                                <div class="space-y-2 p-4 text-white-dark text-[13px]">
                                    <p>Severe trauma or abuse, often experienced during childhood, is linked to the development of dissociative disorders.</p>
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
