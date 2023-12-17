<?php
require '../config.php';

$edit_id = $counselor = array(); // Initializing variables

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM counselors WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $counselor = $result->fetch_assoc();
        } else {
            echo "Counselor not found.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $specialization = $_POST['specialization'];
    $languages = $_POST['languages'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];

    $sql = "UPDATE counselors 
            SET name = ?, description = ?, email = ?, phone_number = ?, specialization = ?, languages = ?, experience = ?, education = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssssssi", $name, $description, $email, $phone_number, $specialization, $languages, $experience, $education, $edit_id);
        
        if ($stmt->execute()) {
            header("Location: ../counsellorAdmin/index.php?updateSuccess=true");
            exit;
        } else {
            echo "Error updating counselor details.";
        }
    } else {
        echo "Prepared statement error.";
    }

    $stmt->close();
    $conn->close();
}

include '../dashboardAdmin/header-main.php';
?>

<ol class="flex text-primary font-semibold dark:text-white-dark">
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]">
        <a href="../dashboardAdmin/dashboard.php" class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">
            Dashboard
        </a>
    </li>
    <li class="bg-[#ebedf2] rounded-tl-md rounded-bl-md dark:bg-[#1b2e4b]">
        <a href="../counsellorAdmin/index.php" class="p-1.5 ltr:pl-3 rtl:pr-3 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-[#ebedf2] before:z-[1] dark:before:border-l-[#1b2e4b] hover:text-primary/70 dark:hover:text-white-dark/70">
            Manage Counsellor
        </a>
    </li>
    <li class="bg-[#ebedf2] dark:bg-[#1b2e4b]">
        <a class="bg-primary text-white-light p-1.5 ltr:pl-6 rtl:pr-6 ltr:pr-2 rtl:pl-2 relative  h-full flex items-center before:absolute ltr:before:-right-[15px] rtl:before:-left-[15px] rtl:before:rotate-180 before:inset-y-0 before:m-auto before:w-0 before:h-0 before:border-[16px] before:border-l-[15px] before:border-r-0 before:border-t-transparent before:border-b-transparent before:border-l-primary before:z-[1]">
            Edit Counselor
        </a>
    </li>
</ol>
<br>

<div class="panel">
    <form method="post" action="../counsellorAdmin/edit.php" class="form">
        <input type="hidden" name="edit_id" value="<?= $edit_id ?>">

        <div class="form-group">
            <label for="name">Counsellor Name:</label>
            <input type="text" name="name" id="name" class="form-input" value="<?= $counselor['name'] ?>" required>
        </div>
        <br>

        <div class="form-group">
            <label for="description">Counsellor Description:</label>
            <textarea name="description" id="description" class="form-input" rows="4"><?= $counselor['description'] ?></textarea>
        </div>
        <br>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-input" value="<?= $counselor['email'] ?>" required>
        </div>
        <br>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number" id="phone_number" class="form-input" value="<?= $counselor['phone_number'] ?>">
        </div>
        <br>

        <div class="form-group">
            <label for="specialization">Specialization:</label>
            <input type="text" name="specialization" id="specialization" class="form-input" value="<?= $counselor['specialization'] ?>">
        </div>
        <br>

        <div class="form-group">
            <label for="languages">Languages Spoken:</label>
            <input type="text" name="languages" id="languages" class="form-input" value="<?= $counselor['languages'] ?>">
        </div>
        <br>

        <div class="form-group">
            <label for="experience">Experience (in years):</label>
            <input type="number" id="experience" class="form-input" value="<?= $counselor['experience'] ?>">
        </div>
        <br>

        <div class="form-group">
            <label for="education">Education:</label>
            <input type="text" id="education" class="form-input" value="<?= $counselor['education'] ?>">
        </div>
        <br>

        <div class="form-group">
            <button type="submit" name="update_counselor" class="btn btn-primary">Update Counselor</button>
        </div>
    </form>
</div>

<?php include '../footer-main.php'; ?>