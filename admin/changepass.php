<?php
// Assuming you have a database connection
$pdo = new PDO("mysql:host=localhost;dbname=expense_db", "root", "");

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have session authentication
    session_start();
    
    // Get user ID from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve current password hash from the database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // User not found, handle accordingly
        echo "User not found";
        exit();
    }

    // Verify old password
    $old_password = $_POST['currentPassword'];
    if (!password_verify($old_password, $user['password'])) {
        // Old password is incorrect, handle accordingly
        echo "Invalid old password";
        exit();
    }

    // Hash the new password
    $new_password = $_POST['newPassword'];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update the password in the database
    $update_stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
    $update_stmt->execute([$hashed_password, $user_id]);

    if ($update_stmt->rowCount() > 0) {
        // Password updated successfully
        echo "Password changed successfully";
    } else {
        // Error updating password
        echo "Error updating password";
    }
    exit(); // Prevent the HTML form from being displayed after processing the form submission
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Daily Expense Tracker System</title>
    <script>
        function changePassword() {
            var currentPassword = document.getElementById('exampleInputOld1').value;
            var newPassword = document.getElementById('exampleInputNew1').value;
            var confirmPassword = document.getElementById('exampleInputConfirm1').value;

            // Check if new password and confirm password match
            if (newPassword !== confirmPassword) {
                alert('New password and confirm password do not match');
                return false;
            }

            // Perform the password change logic here (you may want to send an API request to the server)

            // Display success message (you can replace this with your desired behavior)
            alert('Password changed successfully!');
        }
    </script>
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
                            <form class="pt-3" onsubmit="changePassword()">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputOld1"
                                        name="currentPassword" placeholder="Old Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputNew1"
                                        name="newPassword" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputConfirm1" name="confirmPassword" placeholder="Confirm Password">
                                </div>

                                <div class="mt-3 text-center">
                                    <button type="submit" name="submit"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"><a>SAVE</a></button>
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