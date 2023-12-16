<?php
// Include your configuration file and header
require '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Make sure to validate and sanitize user input to prevent SQL injection
    $counselor_name = $_POST['counselor_name'];
    $counselor_description = $_POST['counselor_description'];
    $counselor_email = $_POST['counselor_email'];
    $counselor_phone = $_POST['counselor_phone'];
    $counselor_picture = $_FILES['counselor_picture'];
    $counselor_specialization = $_POST['counselor_specialization'];
    $counselor_languages = $_POST['counselor_languages'];
    $counselor_experience = $_POST['counselor_experience'];
    $counselor_education = $_POST['counselor_education'];

    // Check if a file is uploaded
    if (!empty($counselor_picture['tmp_name'])) {
        // Specify your upload directory
        $uploadDirectory = '../assets/counsellorPic/';

        // Get file type and create a unique filename
        $fileType = pathinfo($counselor_picture['name'], PATHINFO_EXTENSION);
        $uploadedFileName = uniqid() . '_' . time() . '.' . $fileType;
        $targetFilePath = $uploadDirectory . $uploadedFileName;

        // Check if the uploaded file is an image
        $isValid = getimagesize($counselor_picture['tmp_name']) !== false;

        if ($isValid) {
            // Move the file to the upload directory
            if (move_uploaded_file($counselor_picture['tmp_name'], $targetFilePath)) {
                // Insert data into the counselors table
                $sql = "INSERT INTO counselors (name, description, email, phone_number, picture_path, specialization, languages, experience, education) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("sssssssss", $counselor_name, $counselor_description, $counselor_email, $counselor_phone, $targetFilePath, $counselor_specialization, $counselor_languages, $counselor_experience, $counselor_education);
                    if ($stmt->execute()) {
                        echo "Counselor registration successful!";
                    } else {
                        echo "Error registering counselor.";
                    }
                    $stmt->close();
                } else {
                    echo "Prepared statement error.";
                }
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file format. Please upload an image.";
        }
    } else {
        echo "Please select a file to upload.";
    }
}

include '../dashboardAdmin/header-main.php';

?>

<!-- HTML form for counselor registration -->
<div class="panel">
<form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="counselor_name">Counselor Name:</label>
            <input type="text" name="counselor_name" id="counselor_name" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="counselor_description">Counselor Description:</label>
            <textarea name="counselor_description" id="counselor_description" class="form-textarea" required></textarea>
        </div>
        <div class="form-group">
            <label for="counselor_email">Email:</label>
            <input type="email" name="counselor_email" id="counselor_email" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="counselor_phone">Phone Number:</label>
            <input type="text" name="counselor_phone" id="counselor_phone" class="form-input" required>
        </div>

        <div class="form-group">
            <label for="counselor_specialization">Specialization:</label>
            <input type="text" name="counselor_specialization" id="counselor_specialization" class="form-input"
                required>
        </div>
        <div class="form-group">
            <label for="counselor_languages">Languages Spoken:</label>
            <input type="text" name="counselor_languages" id="counselor_languages" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="counselor_experience">Experience (in years):</label>
            <input type="number" name="counselor_experience" id="counselor_experience" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="counselor_education">Education:</label>
            <input type="text" name="counselor_education" id="counselor_education" class="form-input" required>
        </div>
        <br>

        <div class="form-group">
            <label for="counselor_picture">Counselor Picture:</label>
            <input type="file" name="counselor_picture" id="counselor_picture" accept="image/*">
        </div>
        <br>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Register Counselor</button>
        </div>
    </form>
</div>

<?php include '../footer-main.php'; ?>