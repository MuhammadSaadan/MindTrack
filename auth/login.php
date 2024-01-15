<!DOCTYPE html>
<html>

<head>
    <style>
        .error-box {
            background-color: #ff0000;
            color: #fff;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }

        .error-input {
            border: 2px solid #ff0000;
        }
    </style>
</head>

<body>
    <?php
    session_start(); // Start the session
    include '../header-main-auth.php';
    include '../connect.php'; // Database connection file
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            echo "Email is required.";
        } elseif (empty($password)) {
            echo "Password is required.";
        } else {
            // SQL query to retrieve user from the database using the provided email
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    // Verify the password
                    if (password_verify($password, $user['password'])) {
                        // Password matches, set user session and redirect based on role
                        $_SESSION['user_id'] = $user['id'];

                        // Check user role and redirect accordingly
                        if ($user['usertype'] === 'admin') {
                            $_SESSION['user_type'] = 'admin'; // Set user type here for admin
                            echo '<script>window.location.replace("/dashboardAdmin/dashboard.php");</script>';
                            exit;
                        } else {
                            $_SESSION['user_type'] = 'user'; // Set user type here for a regular user
                            echo '<script>window.location.replace("/dashboardUser/dashboard.php");</script>';
                            exit;
                        }
                    } else {
                        echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                    <script>
                        const coloredToast = () => {
                            const toast = window.Swal.mixin({
                                toast: true,
                                position: 'top',
                                showConfirmButton: false,
                                timer: 3000,
                                showCloseButton: true,
                                customClass: {
                                    popup: 'background-color: #FF0000; color: red; border-radius: 5px;'
                                }
                            });
                            toast.fire({
                                title: 'Invalid Email or Password',
                                icon: ''
                            });
                        };
                        coloredToast();
                    </script>";
                        unset($_SESSION['updateSuccess']); // Clear the success message
                    }
                } else {
                    echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                <script>
                    const coloredToast = () => {
                        const toast = window.Swal.mixin({
                            toast: true,
                            position: 'top',
                            showConfirmButton: false,
                            timer: 3000,
                            showCloseButton: true,
                            customClass: {
                                popup: 'background-color: #FF0000; color: red; border-radius: 5px;'
                            }
                        });
                        toast.fire({
                            title: 'Invalid Email or Password',
                            icon: ''
                        });
                    };
                    coloredToast();
                </script>";
                }
            } else {
                echo "Login failed. Please try again.";
            }

            $stmt->close();
        }
    }

    if (isset($_GET['updateSuccess']) && $_GET['updateSuccess'] == 'true') {
        echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
    <script>
        const coloredToast = () => {
            const toast = window.Swal.mixin({
                toast: true,
                position: 'bottom-start',
                showConfirmButton: false,
                timer: 3000,
                showCloseButton: true,
                customClass: {
                    popup: 'background-color: #5cb85c; color: white; border-radius: 5px;'
                }
            });
            toast.fire({
                title: 'Registered Successfully',
                icon: 'success'
            });
        };
        coloredToast();
    </script>";
        unset($_SESSION['updateSuccess']); // Clear the success message
    
    }

    $conn->close();
    ?>
    <div class="flex justify-center items-center min-h-screen"
        style="background-image: url('/assets/images/cartonbg.jpg'); background-size: cover; background-position: center;"
        dark:bg-image="url('/assets/images/map-dark.svg')">

        <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
            <h2 class="font-bold text-2xl mb-3">Sign In</h2>
            <p class="mb-7">Enter your email and password to login</p>
            <form method="post" action="/auth/login.php" class="space-y-5" onsubmit="return validateForm()">
                <div>
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email" class="form-input" placeholder="Enter Email" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" class="form-input <?php if (isset($errors['password']))
                        echo 'error-input'; ?>" placeholder="Enter Password" />
                </div>
                <button type="submit" class="btn btn-primary w-full">SIGN IN</button>
            </form>
            <div
                class="relative my-7 h-5 text-center before:w-full before:h-[1px] before:absolute before:inset-0 before:m-auto before:bg-[#ebedf2] dark:before:bg-[#253b5c]">
                <div class="font-bold text-white-dark bg-white dark:bg-[#0e1726] px-2 relative z-[1] inline-block">
                    <span>OR</span>
                </div>
            </div>
            <p class="text-center">Don't have an account? <a href="/auth/boxed-signup.php"
                    class="text-primary font-bold hover:underline">Sign Up</a></p>
                    <br>
                    <p class="text-center"> <a href="/auth/index.php"
                    class="text-primary font-bold hover:underline">Change User</a></p>
        </div>
    </div>

    <script>
        function validateForm() {
            let errorElements = document.querySelectorAll('.error-box');
            errorElements.forEach(function (errorElement) {
                errorElement.remove();
            });
            let errorInputs = document.querySelectorAll('.error-input');
            errorInputs.forEach(function (errorInput) {
                errorInput.classList.remove('error-input');
            });

            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let errors = {};

            if (email.trim() === "") {
                errors['email'] = "Email is required.";
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                errors['email'] = "Invalid email format.";
            }

            if (password.trim() === "") {
                errors['password'] = "Password is required.";
            }

            if (Object.keys(errors).length > 0) {
                for (let field in errors) {
                    let inputElement = document.getElementById(field);
                    inputElement.classList.add('error-input');
                    let errorBox = document.createElement('div');
                    errorBox.className = 'error-box';
                    errorBox.innerHTML = errors[field];
                    inputElement.parentElement.appendChild(errorBox);
                }
                return false;
            }
            return true;
        }
    </script>

    <?php include '../footer-main-auth.php'; ?>
</body>

</html>