<?php
session_start();
include '../connect.php'; // Include the connection file

// Check if the user is logged in or redirect to the login page if not
if (!isset($_SESSION['user_id'])) {
    header("Location: /path/to/login.php");
    exit;
}


// Retrieve form data from the session or the database (adjust as needed)
$user_id = $_SESSION['user_id'];
$severity = $_SESSION['severity'];
$comments = $_SESSION['comment'];
$total = $_SESSION['total'];


include '../header-main.php';

?>

<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Dashboard</a>
    </li>
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]"><a href="/selfTest/index.php"
            class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">Mental
            Health Self-Test</a>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
            class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">
            Result</a></li>

</ol>
<br>

<div class="panel" style="margin-bottom: 10px;">
    <h3 class="font-semibold text-5xl mb-4" style="display: inline-block; margin-right: 5px;">
        <?php echo $total; ?>
    </h3>
    <h3 class="font-semibold text-xl mb-4" style="display: inline-block; margin-right: 5px;">
        Points
    </h3>

    <h3 class="font-semibold text-xl mb-4">
        Severity:
        <?php echo $severity; ?>
    </h3>

    <h3 class="font-semibold text-xl mb-4">
        Action:
        <?php echo $comments; ?>
    </h3>


</div>

<div class="panel">
    <?php
    if ($total <= 4) {
        echo '<div class="panel bg-gray-300"><p>Scores ≤4 suggest minimal depression which may not require treatment.</p></div>';
    } elseif ($total >= 5 && $total <= 9) {
        echo '<div class="panel" style="background-color: yellow; "><p>Scores 5-9 suggest mild depression which may require only watchful waiting and repeated PHQ-9 at followup.</p>
        <br><p>WARNING: This patient is having thoughts concerning for suicidal ideation or self-harm, and should be probed further, referred, or transferred for emergency psychiatric evaluation as clinically appropriate and depending on clinician overall risk assessment.</p></div>';
    } elseif ($total >= 10 && $total <= 14) {
        echo '<div class="panel" style="background-color: yellow; "><p>Scores 10-14 suggest moderate depression severity; patients should have a treatment plan ranging form counseling, followup, and/or pharmacotherapy.</p>
        <br><p>WARNING: This patient is having thoughts concerning for suicidal ideation or self-harm, and should be probed further, referred, or transferred for emergency psychiatric evaluation as clinically appropriate and depending on clinician overall risk assessment.</p></div>';
    } elseif ($total >= 15 && $total <= 19) {
        echo '<div class="panel" style="background-color: red; color: white;"><p>Scores 15-19 suggest moderately severe depression; patients typically should have immediate initiation of pharmacotherapy and/or psychotherapy.</p>
        <br><p>WARNING: This patient is having thoughts concerning for suicidal ideation or self-harm, and should be probed further, referred, or transferred for emergency psychiatric evaluation as clinically appropriate and depending on clinician overall risk assessment.</p></div>';
    } else {
        echo '<div class="panel" style="background-color: red; color: white;"><p>Scores 20 and greater suggest severe depression; patients typically should have immediate initiation of pharmacotherapy and expedited referral to a mental health specialist.</p>
        <br><p>WARNING: This patient is having thoughts concerning for suicidal ideation or self-harm, and should be probed further, referred, or transferred for emergency psychiatric evaluation as clinically appropriate and depending on clinician overall risk assessment.</p></div>';
    }
    ?>

</div>
<br>

<div class="panel" style="margin-bottom: 10px;">
    <h3 class="font-semibold text-2xl mb-4" style="display: inline-block; margin-right: 5px;">
        ADVICE
    </h3>
    <p>
        Final diagnosis should be made with clinical interview and mental status examination including assessment of
        patient’s level of distress and functional impairment.
    </p>
    <br>
    <h3 class="font-semibold text-2xl mb-4" style="display: inline-block; margin-right: 5px;">
        MANAGEMENT
    </h3>
    <p>
        PHQ-9 Management Summary
    </p>

    <br>
    <table>
        <thead>
            <tr>
                <th>Score</th>
                <th>Depression Severity</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>0-4</td>
                <td>Minimal or none</td>
                <td>Monitor; may not require treatment</td>
            </tr>
            <tr>
                <td>5-9</td>
                <td>Mild</td>
                <td>Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment</td>
            </tr>
            <tr>
                <td>10-14</td>
                <td>Moderate</td>
                <td>Use clinical judgment (symptom duration, functional impairment) to determine necessity of treatment</td>
            </tr>
            <tr>
                <td>15-9</td>
                <td>Moderately severe</td>
                <td>Warrants active treatment with psychotherapy, medications, or combination</td>
            </tr>
            <tr>
                <td>20-27</td>
                <td>Severe</td>
                <td>Warrants active treatment with psychotherapy, medications, or combination</td>
            </tr>
        </tbody>
    </table>
</div>


<p><button type="button" onclick="window.location.href='/selfTest/view.php'"
                            class="btn btn-primary">View All</button></p>



<?php include '../footer-main.php'; ?>