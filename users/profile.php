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
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Users</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span>Account Settings</span>
        </li>
    </ul>
    <div class="pt-5">
        <div class="flex items-center justify-between mb-5">
            <h5 class="font-semibold text-lg dark:text-white-light">Settings</h5>
        </div>
        <div x-data="{tab: 'home'}">
            <ul
                class="sm:flex font-semibold border-b border-[#ebedf2] dark:border-[#191e3a] mb-5 whitespace-nowrap overflow-y-auto">
                <li class="inline-block">
                    <a href="javascript:;"
                        class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                        :class="{'!border-primary text-primary' : tab == 'home'}" @click="tab='home'">

                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5">
                            <path opacity="0.5"
                                d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        Home
                    </a>
                </li>



            </ul>
            <template x-if="tab === 'home'">
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