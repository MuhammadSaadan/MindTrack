<?php
require '../config.php';

$userData = null;

// Fetch user data from the database
$userQuery = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($userQuery);

if ($result) {
    $userData = $result->fetch_assoc(); // Fetch the user's data
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_profile'])) {
    // Validate user input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $updateQuery = "UPDATE users SET name=?, email=?, password=? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssi", $name, $email, $password, $user_id);
    $stmt->execute();

    header("Location: /users/profile.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteUserId = $_POST['delete_id'];

    // Confirm that the user initiating the delete action is the owner of the account
    if ($deleteUserId == $user_id) {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $deleteUserId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['deletion_success'] = true;
            unset($_SESSION['update_success']);
            header("Location: /auth/signout.php");
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        // Handle unauthorized deletion attempt
        echo "Unauthorized deletion attempt";
    }
}
include '../header-main.php';

?>

<div>
    <ol class="flex text-primary font-semibold dark:text-white-dark">
        <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a href="/dashboardUser/dashboard.php"
                class="p-1.5 px-3 ltr:pl-6 rtl:pr-6 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">User
                Dashboard</a></li>

        <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]"><a
                class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">Profile
                Settings</a>

        </li>


    </ol>
    <div class="pt-5">
        <div class="flex items-center justify-between mb-5">
            
                <h5 class="font-semibold text-lg dark:text-white-light">Settings</h5>
            </div>
        </div>

                <div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                        class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">

                        <h6 class="text-lg font-bold mb-5">General Information</h6>
                        <div class="flex flex-col sm:flex-row">

                            <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" value="<?php echo $userData['name']; ?>"
                                        class="form-input" required />
                                </div>
                                <div>
                                    <label for="name">E-mail</label>
                                    <input id="name" type="email" name="email" value="<?php echo $userData['email']; ?>"
                                        class="form-input" required />
                                </div>
                                <div>
                                    <label for="name">Password</label>
                                    <input id="password" type="password" name="password"
                                        value="<?php echo $userData['password']; ?>" class="form-input" required />
                                </div>

                                <div class="sm:col-span-2 mt-3">
                                    <button type="submit" name="edit_profile" class="btn btn-primary">Save</button>
                                </div>


                            </div>
                        </div>
                    </form>


                </div>
            </template>


            <div class="panel space-y-5">

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" <h5>

                    <h5 class="text-lg font-bold mb-5">Delete Account</h5>
                    <p class="mb-5">Once you delete your account, there is no going back. Please be certain.</p>
                    <div style="text-align: right;">
                        <button type="button" name="delete_id" class="btn btn-danger"
                            onclick="showAlert(<?php echo $userData['id']; ?>)">Delete
                            my account</button>
                    </div>
            </div>

            </form>

        </div>
    </div>
</div>

<script>

    async function showAlert(deleteUserId) {
        const swalWithBootstrapButtons = window.Swal.mixin({
            confirmButtonClass: 'btn btn-secondary',
            cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: '<div style="text-align: center;">Are you sure?</div>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                padding: '2em',
            })
            .then((result) => {
                if (result.value) {
                    deleteLog(deleteUserId);
                }

            });
    }

    async function deleteLog(deleteUserId) {
        const formData = new FormData();
        formData.append('delete_id', deleteUserId);

        try {
            const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                const swalWithBootstrapButtons = window.Swal.mixin({
                    confirmButtonClass: 'btn btn-secondary',
                    cancelButtonClass: 'btn btn-dark ltr:mr-3 rtl:ml-3',
                    buttonsStyling: false,
                });

                // If deletion was successful, display the success message
                swalWithBootstrapButtons.fire('Account Deleted');

                setTimeout(() => {
                    window.location.href = '/auth/signout.php';
                }, 1500);
            } else {
                swalWithBootstrapButtons.fire('Error', 'Failed to delete account', 'error');
            }
        } catch (error) {
            // Handle any unexpected errors
            swalWithBootstrapButtons.fire('Error', 'An unexpected error occurred.', 'error');
        }
    }

</script>

<?php include '../footer-main.php'; ?>