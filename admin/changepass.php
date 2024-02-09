<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "expense_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user ID from the session
    $user_id = $_SESSION['id'];

    // Retrieve form data
    $old_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];

    // Validate form data
    if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
        echo "All fields are required.";
        exit();
    }

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        echo "New password and confirm password do not match.";
        exit();
    }

    // Hash the old password to compare with the stored password in the database
    $old_password_hashed = hash('sha256', $old_password);

    // Check if the old password matches the one stored in the database
    $sql = "SELECT * FROM users WHERE id = ? AND password = ?";
    echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $old_password_hashed);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Old password is correct, update the password in the database
        $new_password_hashed = hash('sha256', $new_password);
        $update_sql = "UPDATE users SET password = ? WHERE id = ?";
        echo $update_sql;
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $new_password_hashed, $user_id);
        if ($update_stmt->execute()) {
            echo "Password changed successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "Incorrect old password.";
    }

    // Close statement and connection
    $stmt->close();
    if (isset($update_stmt)) {
        $update_stmt->close();
    }
 
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daily Expense Tracker System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="assets/images/logo.png">
                            </div>
                            <h4>Want to Change Password?</h4>
                            <form class="pt-3" action="" method="post">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputOld1"
                                        name="currentPassword" placeholder="Old Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputNew1"
                                        name="newPassword" placeholder="New Password" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputConfirm1" name="confirmPassword" placeholder="Confirm Password" required>
                                </div>

                                <div class="mt-3 text-center">
                                    <button type="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SAVE</button>
                                    <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                        href="index.php">BACK</a>
                                </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>
