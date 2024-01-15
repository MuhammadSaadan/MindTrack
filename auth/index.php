<!DOCTYPE html>
<html>

<?php
include '../header-main-auth.php';
include '../connect.php'; // Database connection file

$conn->close();
?>

<head>
    <style>
        .card:hover {
            transform: scale(1.02);
            box-shadow: 8px 12px 20px -6px #bfc9d4;
        }

        .card {
            margin: 15px;
            transition: transform 0.3s ease-in-out;
        }

        .welcome-heading {
            font-size: 3rem;
            font-weight: bold;
            color: white;
            margin-bottom: 1rem;
            text-align: center;
        }

        .login-heading {
            font-size: 1.8rem; /* Adjusted font size for "Login As" */
            font-weight: normal;
            color: white;
            text-align: center;
            margin: 0; /* Reset margin to remove extra spacing */
        }
    </style>
</head>

<body>
    <div class="flex flex-col items-center justify-center min-h-screen"
        style="background-image: url('/assets/images/cartonbg.jpg'); background-size: cover; background-position: center;"
        dark:bg-image="url('/assets/images/map-dark.svg')">

        <h1 class="welcome-heading dark:text-white-light">Welcome to Mindtrack</h1>
        <br>
        <br>
        <h2 class="login-heading text-3xl text-white mb-8 dark:text-white-light">Login As</h2>
        <br>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <!-- User card as button -->
            <a href="/auth/login.php" style="width: calc(320px + 2px); height: 420px;"
                class="card bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded-lg border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none transition duration-300 ease-in-out transform">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 rounded-tl rounded-tr h-[200px] overflow-hidden">
                        <img src="/assets/images/userprofilepic.png" alt="User Image"
                            style="width: 100%; height: 100%; object-fit: cover; transform: scale(1.02);"
                            class="rounded-lg" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">User</h5>
                    <p class="text-white-dark">Track your mental health today!.</p>
                </div>
            </a>

            <!-- Counsellor card as button -->
            <a href="/auth/logincounsellor.php" style="width: calc(320px + 2px); height: 420px;"
                class="card bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded-lg border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none transition duration-300 ease-in-out transform">
                <div class="py-7 px-6">
                    <div class="-mt-7 mb-7 rounded-tl rounded-tr h-[200px] overflow-hidden">
                        <img src="/assets/images/user2profilepic.png" alt="Counselor Image"
                            style="width: 100%; height: 100%; object-fit: cover; transform: scale(1.02);"
                            class="rounded-lg" />
                    </div>
                    <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Counsellor</h5>
                    <p class="text-white-dark">Assess patient mental health.</p>
                </div>
            </a>
        </div>
    </div>

    <?php include '../footer-main-auth.php'; ?>
</body>

</html>
