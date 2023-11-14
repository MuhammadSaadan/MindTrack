<?php
session_start();

include '../connect.php'; // Include the connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ensure the user_id, type, and total are set appropriately
    $user_id = $_SESSION['user_id']; // Set the user ID (Assuming it's stored in a session)

    // Extract values for each question
    $q1 = isset($_POST['q1']) ? $_POST['q1'] : 0;
    $q2 = isset($_POST['q2']) ? $_POST['q2'] : 0;
    $q3 = isset($_POST['q3']) ? $_POST['q3'] : 0;
    $q4 = isset($_POST['q4']) ? $_POST['q4'] : 0;
    $q5 = isset($_POST['q5']) ? $_POST['q5'] : 0;
    $q6 = isset($_POST['q6']) ? $_POST['q6'] : 0;
    $q7 = isset($_POST['q7']) ? $_POST['q7'] : 0;
    $q8 = isset($_POST['q8']) ? $_POST['q8'] : 0;
    $q9 = isset($_POST['q9']) ? $_POST['q9'] : 0;

    // Calculate the total score
    $total = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9;

    // Determine depression severity based on the total score
    if ($total >= 0 && $total <= 4) {
        $severity = 'Minimal or none';
        $comments = 'Monitor; may not require treatment';
    } elseif ($total >= 5 && $total <= 9) {
        $severity = 'Mild';
        $comments = 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment';
    } elseif ($total >= 10 && $total <= 14) {
        $severity = 'Moderate';
        $comments = 'Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment';
    } elseif ($total >= 15 && $total <= 19) {
        $severity = 'Moderately severe';
        $comments = 'Warrants active treatment with psychotherapy, medications, or combination';
    } else {
        $severity = 'Severe';
        $comments = 'Warrants active treatment with psychotherapy, medications, or combination';
    }

    // Set session variables
    $_SESSION['severity'] = $severity;
    $_SESSION['total'] = $total;
    $_SESSION['comment'] = $comments;


    // Insert the questionnaire data into the database
    $sql = "INSERT INTO ph9_question (user_id, severity, question_1, question_2, question_3, question_4, question_5, question_6, question_7, question_8, question_9, comment, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssssssi", $user_id, $severity, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $comments, $total);
    $stmt->execute();
    $stmt->close();

    // Display success message or perform further actions after submission
    header("Location: /selfTest/result.php");
    exit();
}

include '../header-main.php';



$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <script defer src="/assets/js/apexcharts.js"></script>
</head>

<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Mental
            Health Self-Test</a></li>

</ol>
<br>


<div x-data="charts">
    <div
        class="prose bg-[#f1f2f3] px-6 py-10 sm:px-10 sm:py-16 rounded max-w-full dark:bg-[#1b2e4b] dark:text-white-light">
        <h2 class="text-4xl md:text-5xl mb-4 mt-6 text-center dark:text-white-light">Mental-Health Self Test</h2>
        <hr class="my-4 dark:border-[#191e3a]">
        <p class="text-center text-lg text-gray-600 dark:text-gray-400">Evaluate your Depression Severity.</p>
    </div>

    <br>
</div>



<br>

<div class="panel bg-gray-300">


    <!-- justify pills -->
    <div class="mb-5" x-data="{tab : 'home'}">
        <!-- buttons -->
        <div>
            <ul class="flex flex-wrap justify-between mt-3 space-x-2 rtl:space-x-reverse">
                <li class="flex-auto text-center">
                    <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                        :class="{'bg-info text-white' : tab === 'home'}" @click="tab = 'home'">When to Use?</a>
                </li>
                <li class="flex-auto text-center">
                    <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                        :class="{'bg-info text-white' : tab === 'profile'}" @click="tab = 'aim'">Pearls/Pitfalls</a>
                </li>
                <li class="flex-auto text-center">
                    <a href="javascript:" class="p-3.5 py-2 -mb-[1px] block hover:bg-info rounded hover:text-white"
                        :class="{'bg-info text-white' : tab === 'contact'}" @click="tab = 'objective'">Why Use</a>
                </li>
            </ul>
        </div>

        <!-- description -->
        <div class="pt-5 flex-1 text-sm">
            <template x-if="tab === 'home'">
                <div>
                    <h4 class="font-semibold text-2xl mb-4"></h4>
                    <p class="mb-4">
                        Use as a screening tool:
                    </p>
                    <p class="mb-4">
                        • To assist the clinician in making the diagnosis of depression.

                    </p>
                    <p class="mb-4">

                        • To quantify depression symptoms and monitor severity.
                    </p>

                </div>
            </template>
            <template x-if="tab === 'aim'">
                <div>
                    <h4 class="font-semibold text-2xl mb-4"></h4>
                    <p class="mb-4">• The PHQ-9 is a component focused on major depressive disorder (MDD) within the
                        broader Patient Health Questionnaire.
                    </p>
                    <p class="mb-4">• Each of the 9 DSM criteria for MDD is rated on a scale from "0" (absent) to "3"
                        (nearly every day), resulting in a severity score ranging from 0 to 27.
                    </p>
                    <p class="mb-4">• Elevated PHQ-9 scores are linked to reduced functional status, increased
                        difficulties related to symptoms, more sick days, and higher healthcare utilization.
                    </p>
                    <p class="mb-4">• Notably, there may be a high rate of false-positive results in primary care
                        settings, with one meta-analysis revealing that only 50% of patients screening positive actually
                        had major depression (Levis 2019).

                </div>
            </template>
            <template x-if="tab === 'objective'">
                <div>
                    <h4 class="font-semibold text-2xl mb-4"></h4>
                    <p>
                        Objectively determines severity of initial symptoms, and also monitors symptom changes and
                        treatment effects over time.
                    </p>

                </div>
            </template>
        </div>
    </div>

</div>

<br>
<div class="panel">
    <h4 class="font-semibold text-2xl mb-4">PHQ-9 (Patient Health Questionnaire-9)
    </h4>
</div>
<br>
<main>
    <form method="post" action="/selfTest/index.php" id="phqForm">
        <div class="question">
            <div class="panel">
                <label>Little interest or pleasure in doing things?</label>
                </br>
                <p>
                    <label><input type="radio" name="q1" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q1" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q1" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q1" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>
        <div class="question">
            <div class="panel">

                <label>Feeling down, depressed, or hopeless?</label>
                </br>

                <p>
                    <label><input type="radio" name="q2" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q2" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q2" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q2" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>

        <div class="question">
            <div class="panel">

                <label>Trouble falling or staying asleep, or sleeping too much?</label>
                </br>

                <p>
                    <label><input type="radio" name="q3" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q3" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q3" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q3" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <div class="question">
            <div class="panel">

                <label>Feeling tired or having little energy?</label>
                </br>

                <p>
                    <label><input type="radio" name="q4" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q4" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q4" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q4" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>

        </br>

        <div class="question">
            <div class="panel">

                <label>Poor appetite or overeating?</label>
                </br>

                <p>
                    <label><input type="radio" name="q5" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q5" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q5" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q5" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <div class="question">
            <div class="panel">

                <label>Feeling bad about yourself or that you are a failure or have let yourself or your family
                    down?</label>
                </br>

                <p>
                    <label><input type="radio" name="q6" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q6" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q6" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q6" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <div class="question">
            <div class="panel">

                <label>Trouble concentrating on things, such as reading the newspaper or watching
                    television?</label>

                </br>

                <p>
                    <label><input type="radio" name="q7" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q7" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q7" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q7" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <div class="question">
            <div class="panel">

                <label>Moving or speaking so slowly that other people could have noticed? Or the opposite: being
                    so
                    fidgety or restless that you have been moving around a lot more than usual?</label>
                </br>

                <p>
                    <label><input type="radio" name="q8" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q8" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q8" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q8" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <div class="question">
            <div class="panel">

                <label>Thoughts that you would be better off dead or of hurting yourself?</label>
                <p>
                    </br>

                    <label><input type="radio" name="q9" value="0" required> Not at all</label><br>
                    <label><input type="radio" name="q9" value="1" required> Several days</label><br>
                    <label><input type="radio" name="q9" value="2" required> More than half the days</label><br>
                    <label><input type="radio" name="q9" value="3" required> Nearly every day</label>
                </p>
            </div>
        </div>
        </br>


        <p><button type="submit" class="btn btn-primary">Submit</button></p>
    </form>
    <div id="result"></div>
</main>
</div>


</html>
<?php include '../footer-main.php'; ?>