<?php
// Start session
session_start();

// Include database connection
include("db_connect.php");

// Retrieve current user details from the database
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result !== false) {
    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        // Handle the case where user details are not found
        $userDetails = array(); // Empty array if user not found
    }
} else {
    // Handle the case where the SQL query fails
    die("Error: " . $conn->error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate the form data (you should add more validation)
    $newName = mysqli_real_escape_string($conn, $_POST['new_name']);
    $newEmail = mysqli_real_escape_string($conn, $_POST['new_email']);
    $newGender = mysqli_real_escape_string($conn, $_POST['new_gender']);
    $newMobileNumber = mysqli_real_escape_string($conn, $_POST['new_mobile_number']);

    // Handle profile image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["profile_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["profile_image"]["name"]) . " has been uploaded.";
            // Update user details in the database including profile image path
            $updateSql = "UPDATE users SET username = '$newName', email = '$newEmail', gender = '$newGender', mobile_number = '$newMobileNumber', profile_image = '$targetFile' WHERE id = $user_id";

            if ($conn->query($updateSql) === true) {
                // Update the userDetails array for display
                $userDetails['username'] = $newName;
                $userDetails['email'] = $newEmail;
                $userDetails['gender'] = $newGender;
                $userDetails['mobile_number'] = $newMobileNumber;
                $userDetails['profile_image'] = $targetFile;

                echo "Profile updated successfully!";
            } else {
                echo "Error updating profile: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expense Tracker System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Profile</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="new_name">New Name:</label>
                <input type="text" id="new_name" name="new_name" class="form-control" value="<?php echo isset($userDetails['username']) ? $userDetails['username'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_email">New Email:</label>
                <input type="email" id="new_email" name="new_email" class="form-control" value="<?php echo isset($userDetails['email']) ? $userDetails['email'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_gender">Gender:</label>
                <input type="text" id="new_gender" name="new_gender" class="form-control" value="<?php echo isset($userDetails['gender']) ? $userDetails['gender'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_mobile_number">Mobile Number:</label>
                <input type="text" id="new_mobile_number" name="new_mobile_number" class="form-control" value="<?php echo isset($userDetails['mobile_number']) ? $userDetails['mobile_number'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
