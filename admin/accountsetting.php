<?php
session_start(); // Start the session

// Include the database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "expense_db";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    // Redirect to the login page or display an error message
    // header("Location: login.php");
    // exit(); // Stop further execution
}

// Retrieve the admin's current details from the database
$admin_id = $_SESSION['id'];
$selectQuery = "SELECT * FROM admins WHERE id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    // $password = $_POST["password"];
    $mobile_number = $_POST["mobile_number"];
    $gender = $_POST["gender"];

    // Update the admin's details in the database
    if ($_FILES['profile_image']['name'] != '') {
        // Handle the file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image or fake image
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["profile_image"]["name"]) . " has been uploaded.";
                $profile_image_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // If no file is selected, keep the existing profile image
        $profile_image_path = $admin['profile_image'];
    }

    // Update the admin's details in the database
    $updateQuery = "UPDATE admins SET username=?, email=?, mobile_number=?, gender=?, profile_image=? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $username, $email, $mobile_number, $gender, $profile_image_path, $admin_id);
    if ($stmt->execute()) {
        echo "Admin details updated successfully";
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating admin details: " . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expense Tracker System</title>
    <style>
        .main {
            display: flex;
            padding-top: 70px;

        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
    </style>
      <!-- plugins:css -->
      <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

</head>

<body>
    <header>
        <?php
        include("header.php");
        ?>
    </header>

    <div class="main">
        <sidebar>
            <?php
            include("sidebar.php");
            ?>
        </sidebar>

<body>
    <div class="container mt-5">
        <h2>Update Profile</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $admin['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $admin['mobile_number']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php if ($admin['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($admin['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Others" <?php if ($admin['gender'] == 'Others') echo 'selected'; ?>>Others</option>
                </select>
            </div>
            <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                    <?php
                    if (isset($admin['profile_image']) && !empty($admin['profile_image'])) {
                        echo '<img src="uploads/' . $admin['profile_image'] . '" alt="profile">';
                    }
                    ?>
                </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
 <!-- Bootstrap JS and Popper.js -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </div>
    <footer>
        <?php
        include("footer.php");
        ?>
    </footer>
</body>

</html>
