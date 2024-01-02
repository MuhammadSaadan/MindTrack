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
    include '../connect.php';

    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (empty($name)) {
            $errors['name'] = "Name is required.";
        }
        if (empty($phone)) {
            $errors['phone'] = "Phone number is required.";
        } elseif (!preg_match("/^\d{10}$/", $phone)) {
            $errors['phone'] = "Invalid phone number format.";
        }
        if (empty($email)) {
            $errors['email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
        if (empty($_POST['password'])) {
            $errors['password'] = "Password is required.";
        }

        if (empty($errors)) {
            $emailCheckSql = "SELECT id FROM users WHERE email = ?";
            $emailCheckStmt = $conn->prepare($emailCheckSql);

            if ($emailCheckStmt) {
                $emailCheckStmt->bind_param("s", $email);
                $emailCheckStmt->execute();
                $emailCheckStmt->store_result();

                if ($emailCheckStmt->num_rows > 0) {
                    $errors['email'] = "Email already exists. Please use a different email.";
                }

                $emailCheckStmt->close();
            } else {
                $errors['email'] = "Email validation failed.";
            }

            if (empty($errors)) {
                $insertSql = "INSERT INTO users (usertype, name,phone, email, password) VALUES ('user', ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);

                if ($insertStmt) {
                    $insertStmt->bind_param("ssss", $name, $phone, $email, $password);
                    if ($insertStmt->execute()) {
                        header("Location: /auth/login.php?updateSuccess=true");
                        exit;

                    } else {
                        $errors[] = "Registration failed: " . $conn->error;
                    }
                    $insertStmt->close();
                } else {
                    $errors[] = "Registration failed: " . $conn->error;
                }
            }
        }
    }

    $conn->close();

    include '../header-main-auth.php';

    ?>
    <div class="flex justify-center items-center min-h-screen"
        style="background-image: url('/assets/images/bglogin.svg'); background-size: cover; background-position: center;"
        dark:bg-image="url('/assets/images/map-dark.svg')">

        <div class="panel sm:w-[480px] m-6 max-w-lg w-full">
            <h2 class="font-bold text-2xl mb-3">Sign Up</h2>
            <p class="mb-7">Enter your email and password to register</p>
            <form method="post" action="/auth/boxed-signup.php" class="space-y-5" onsubmit="return validateForm()">

                <div>
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" class="form-input <?php if (isset($errors['name']))
                        echo 'error-input'; ?>" placeholder="Enter Name" />
                    <?php if (isset($errors['name']))
                        echo '<div class="error-box">' . $errors['name'] . '</div>'; ?>
                </div>
                <div>
                    <label for="phone">Phone Number</label>
                    <input name="phone" id="phone" type="text" class="form-input <?php if (isset($errors['phone']))
                        echo 'error-input'; ?>" placeholder="Enter Phone Number" />
                    <?php if (isset($errors['phone']))
                        echo '<div class="error-box">' . $errors['phone'] . '</div>'; ?>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email" class="form-input <?php if (isset($errors['email']))
                        echo 'error-input'; ?>" placeholder="Enter Email" />
                    <?php if (isset($errors['email']))
                        echo '<div class="error-box">' . $errors['email'] . '</div>'; ?>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input name="password" id="password" type="password" class="form-input <?php if (isset($errors['password']))
                        echo 'error-input'; ?>" placeholder="Enter Password" />
                    <?php if (isset($errors['password']))
                        echo '<div class="error-box">' . $errors['password'] . '</div>'; ?>
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-full">SIGN UP</button>
            </form>

            <br>
            <p class="text-center">Already have an account? <a href="/auth/login.php"
                    class="text-primary font-bold hover:underline">Sign In</a></p>
        </div>
    </div>

    <script>
        console.log('Script loaded');
        function validateForm() {
            let errorElements = document.querySelectorAll('.error-box');
            errorElements.forEach(function (errorElement) {
                errorElement.remove();
            });
            let errorInputs = document.querySelectorAll('.error-input');
            errorInputs.forEach(function (errorInput) {
                errorInput.classList.remove('error-input');
            });

            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let errors = {};

            if (name.trim() === "") {
                errors['name'] = "Name is required.";
            }

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

        // Function to show success message
        function showAlert() {
            new window.Swal({
                icon: 'success',
                position: 'top'
                title: 'Registration Successful!',
                text: 'You have successfully signed up.',
                padding: '2em',
            });
        }
    </script>

    <?php include '../footer-main-auth.php'; ?>
</body>

</html>